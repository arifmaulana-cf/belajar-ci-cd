<?php

namespace App\Console\Commands;

use App\Models\Plant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;
use ZipArchive;

class ImportPlantImages extends Command
{
    protected $signature = 'plants:import-images
        {zip? : Path ke ZIP folder Drive (berisi file DSC_XXXX.JPG)}
        {--force : Hapus & buat ulang record yang sudah ada (berdasarkan kode)}';

    protected $description = 'Import 35 gambar tanaman dari ZIP Drive ke storage lokal & buat record Plant baru (TMB-03..TMB-37)';

    /**
     * Mapping nama tanaman -> nomor DSC (dari list user).
     * Foto ganda (#10 DSC5358, #16 DSC5356) disimpan 1 utama saja.
     * Entri tanpa nama -> placeholder Tanaman-DSCxxxx.
     */
    private array $map = [
        ['kode' => 'TMB-03', 'nama' => 'Rambe kokora',            'dsc' => 5403],
        ['kode' => 'TMB-04', 'nama' => 'Bebesi',                  'dsc' => 5396],
        ['kode' => 'TMB-05', 'nama' => 'Cempedak air',           'dsc' => 5393],
        ['kode' => 'TMB-06', 'nama' => 'Akar 3 urat',            'dsc' => 5391],
        ['kode' => 'TMB-07', 'nama' => 'Risung',                  'dsc' => 5389],
        ['kode' => 'TMB-08', 'nama' => 'Anggrek',                'dsc' => 5387],
        ['kode' => 'TMB-09', 'nama' => 'Jengkol',                'dsc' => 5385],
        ['kode' => 'TMB-10', 'nama' => 'Kabo',                   'dsc' => 5382],
        ['kode' => 'TMB-11', 'nama' => 'Bulu ayam',              'dsc' => 5380],
        ['kode' => 'TMB-12', 'nama' => 'Mayang susu',            'dsc' => 5378],
        ['kode' => 'TMB-13', 'nama' => 'Kayu mayang',            'dsc' => 5375],
        ['kode' => 'TMB-14', 'nama' => 'Cempedak Rawan',         'dsc' => 5372],
        ['kode' => 'TMB-15', 'nama' => 'Akar kuning / bajakah',  'dsc' => 5367],
        ['kode' => 'TMB-16', 'nama' => 'Semantok',               'dsc' => 5364],
        ['kode' => 'TMB-17', 'nama' => 'buah meranti',           'dsc' => 5363],
        ['kode' => 'TMB-18', 'nama' => 'meranti Putih',          'dsc' => 5352],
        ['kode' => 'TMB-19', 'nama' => 'Pala hutan',             'dsc' => 5350],
        ['kode' => 'TMB-20', 'nama' => 'Pinang hutan',           'dsc' => 5347],
        ['kode' => 'TMB-21', 'nama' => 'Tanaman-DSC5345',        'dsc' => 5345],
        ['kode' => 'TMB-22', 'nama' => 'Asam babi',              'dsc' => 5341],
        ['kode' => 'TMB-23', 'nama' => 'Tanaman-DSC5336',        'dsc' => 5336],
        ['kode' => 'TMB-24', 'nama' => 'ririnai',                'dsc' => 5334],
        ['kode' => 'TMB-25', 'nama' => 'gaharu',                 'dsc' => 5329],
        ['kode' => 'TMB-26', 'nama' => 'Pasak bumi',             'dsc' => 5322],
        ['kode' => 'TMB-27', 'nama' => 'Rambutan hutan',         'dsc' => 5417],
        ['kode' => 'TMB-28', 'nama' => 'Pala hutan kecil',       'dsc' => 5420],
        ['kode' => 'TMB-29', 'nama' => 'Jambu gunung',           'dsc' => 5421],
        ['kode' => 'TMB-30', 'nama' => 'Jambu baateh',           'dsc' => 5424],
        ['kode' => 'TMB-31', 'nama' => 'Mangga hutan',           'dsc' => 5428],
        ['kode' => 'TMB-32', 'nama' => 'Kayu kelat',             'dsc' => 5436],
        ['kode' => 'TMB-33', 'nama' => 'Durian cangok',          'dsc' => 5441],
        ['kode' => 'TMB-34', 'nama' => 'Durian hutan',           'dsc' => 5449],
        ['kode' => 'TMB-35', 'nama' => 'Bebahru',                'dsc' => 5451],
        ['kode' => 'TMB-36', 'nama' => 'Baukangit',              'dsc' => 5454],
        ['kode' => 'TMB-37', 'nama' => 'Limao hantu',            'dsc' => 5459],
    ];

    public function handle(): int
    {
        $zip = $this->argument('zip') ?: storage_path('app/plant_images.zip');

        if (!file_exists($zip)) {
            $this->error("ZIP tidak ditemukan: {$zip}");
            return 1;
        }

        $extract = storage_path('app/plant_import_tmp');

        // Bersihkan sisa ekstraksi lama
        if (is_dir($extract)) {
            (new \Illuminate\Support\Facades\File)::deleteDirectory($extract);
        }

        $this->info("Mengekstrak ZIP...");
        $za = new ZipArchive();
        if ($za->open($zip) !== true) {
            $this->error("Gagal membuka ZIP.");
            return 1;
        }
        $za->extractTo($extract);
        $za->close();

        // Index semua file hasil ekstrak berdasarkan nama (uppercase)
        $found = [];
        $finder = Finder::create()->files()->in($extract);
        foreach ($finder as $file) {
            $found[strtoupper($file->getFilename())] = $file->getRealPath();
        }

        $created = 0;
        $skipped = 0;
        $missingImg = 0;

        foreach ($this->map as $entry) {
            $kode = $entry['kode'];
            $nama = $entry['nama'];
            $dsc  = $entry['dsc'];

            // Cek duplikat
            $existing = Plant::where('kode_tumbuhan', $kode)->first();
            if ($existing && !$this->option('force')) {
                $this->warn("{$kode} sudah ada, lewati.");
                $skipped++;
                continue;
            }

            // Cari file gambar
            $target = null;
            foreach (["DSC_{$dsc}.JPG", "DSC_{$dsc}.jpg", "DSC_{$dsc}.JPEG", "DSC {$dsc}.JPG"] as $cand) {
                if (isset($found[strtoupper($cand)])) {
                    $target = $found[strtoupper($cand)];
                    break;
                }
            }

            $gambar = null;
            if ($target) {
                $ext = strtolower(pathinfo($target, PATHINFO_EXTENSION)) ?: 'jpg';
                $newName = Str::random(40) . '.' . $ext;
                Storage::disk('public')->put('plants/' . $newName, file_get_contents($target));
                $gambar = 'plants/' . $newName;
            } else {
                $this->warn("Gambar DSC_{$dsc} tidak ditemukan untuk {$kode} ({$nama})");
                $missingImg++;
            }

            $data = [
                'kode_tumbuhan' => $kode,
                'nama_tumbuhan' => $nama,
                'nama_latin'    => '',
                'famili'        => '',
                'deskripsi'     => '',
                'gambar'        => $gambar,
            ];

            if ($existing && $this->option('force')) {
                // Hapus gambar lokal lama bila ada
                if ($existing->gambar && !filter_var($existing->gambar, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($existing->gambar);
                }
                $existing->update($data);
                $this->line("Diperbarui: {$kode}");
            } else {
                Plant::create($data);
                $this->line("Dibuat: {$kode} - {$nama}" . ($gambar ? '' : ' (tanpa gambar)'));
            }

            $created++;
        }

        // Bersihkan folder ekstrak
        (new \Illuminate\Support\Facades\File)::deleteDirectory($extract);

        $this->info("Selesai. Dibuat/diperbarui: {$created}, dilewati: {$skipped}, tanpa gambar: {$missingImg}");

        return 0;
    }
}
