<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk fitur insert log ke database

class PlantController extends Controller
{
    // Menampilkan daftar semua tumbuhan di admin
    public function index()
    {
        $plants = Plant::latest()->paginate(10);
        return view('admin.plants.index', compact('plants'));
    }

    // Menampilkan form tambah tumbuhan
    public function create()
    {
        return view('admin.plants.create');
    }

    // Menyimpan data tumbuhan baru + Generate QR Code
    public function store(Request $request)
    {
        $request->validate([
            'kode_tumbuhan'    => 'required|unique:plants,kode_tumbuhan',
            'nama_tumbuhan'    => 'required|string|max:255',
            'nama_latin'       => 'required|string|max:255',
            'famili'           => 'nullable|string|max:255',
            'deskripsi'        => 'required',
            'gambar_file'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_url'       => 'nullable|url|max:500',
        ]);

        $data = $request->except(['gambar_file', 'gambar_url']);

        // Handle Upload Gambar Tumbuhan dari perangkat
        if ($request->hasFile('gambar_file')) {
            $data['gambar'] = $request->file('gambar_file')->store('plants', 'public');
        }
        // Handle input tautan gambar eksternal (Google Drive / OneDrive / dll)
        elseif ($request->filled('gambar_url')) {
            $url = $request->gambar_url;

            // Konversi otomatis link sharing Google Drive biasa agar menjadi direct image link
            if (str_contains($url, 'drive.google.com') && str_contains($url, '/file/d/')) {
                preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches);
                if (isset($matches[1])) {
                    $url = 'https://drive.google.com/uc?export=view&id=' . $matches[1];
                }
            }

            $data['gambar'] = $url;
        }

        // Generate QR Code yang mengarah ke halaman detail publik tumbuhan
        $urlDetail = route('plant.detail', $request->kode_tumbuhan);

        // Buat folder penyimpanan jika belum ada
        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        $qrFileName = 'qrcodes/' . $request->kode_tumbuhan . '.svg';

        // Generate dan simpan QR Code dalam format SVG
        $qrCodeImage = QrCode::format('svg')->size(300)->generate($urlDetail);
        Storage::disk('public')->put($qrFileName, $qrCodeImage);

        $data['qr_code_path'] = $qrFileName;

        Plant::create($data);

        return redirect()->route('admin.plants.index')->with('success', 'Data tumbuhan dan QR Code berhasil ditambahkan!');
    }

    // Menampilkan detail tumbuhan di panel admin
    public function show(Plant $plant)
    {
        return view('admin.plants.show', compact('plant'));
    }

    // Menampilkan form edit
    public function edit(Plant $plant)
    {
        return view('admin.plants.edit', compact('plant'));
    }

    // Memperbarui data tumbuhan
    public function update(Request $request, Plant $plant)
    {
        $request->validate([
            'kode_tumbuhan'    => 'required|unique:plants,kode_tumbuhan,' . $plant->id,
            'nama_tumbuhan'    => 'required|string|max:255',
            'nama_latin'       => 'required|string|max:255',
            'famili'           => 'nullable|string|max:255',
            'deskripsi'        => 'required',
            'gambar_file'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_url'       => 'nullable|url|max:500',
        ]);

        $data = $request->except(['gambar_file', 'gambar_url']);

        // Jika admin mengunggah file gambar baru
        if ($request->hasFile('gambar_file')) {
            // Hapus file lama jika sebelumnya tersimpan secara lokal (bukan URL)
            if ($plant->gambar && !filter_var($plant->gambar, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($plant->gambar);
            }
            $data['gambar'] = $request->file('gambar_file')->store('plants', 'public');
        }
        // Jika admin memasukkan tautan URL gambar baru
        elseif ($request->filled('gambar_url')) {
            // Hapus file lokal lama jika sebelumnya upload dari file
            if ($plant->gambar && !filter_var($plant->gambar, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($plant->gambar);
            }
            
            $url = $request->gambar_url;
            if (str_contains($url, 'drive.google.com') && str_contains($url, '/file/d/')) {
                preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches);
                if (isset($matches[1])) {
                    $url = 'https://drive.google.com/uc?export=view&id=' . $matches[1];
                }
            }
            $data['gambar'] = $url;
        }

        // Jika kode tumbuhan berubah, perbarui juga QR code-nya
        if ($request->kode_tumbuhan !== $plant->kode_tumbuhan) {
            if ($plant->qr_code_path) {
                Storage::disk('public')->delete($plant->qr_code_path);
            }
            $urlDetail  = route('plant.detail', $request->kode_tumbuhan);
            $qrFileName = 'qrcodes/' . $request->kode_tumbuhan . '.svg';
            Storage::disk('public')->put($qrFileName, QrCode::format('svg')->size(300)->generate($urlDetail));
            $data['qr_code_path'] = $qrFileName;
        }

        $plant->update($data);

        return redirect()->route('admin.plants.index')->with('success', 'Data tumbuhan berhasil diperbarui!');
    }

    // Menghapus data tumbuhan
    public function destroy(Plant $plant)
    {
        // Hapus file gambar lokal jika ada
        if ($plant->gambar && !filter_var($plant->gambar, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($plant->gambar);
        }
        if ($plant->qr_code_path) {
            Storage::disk('public')->delete($plant->qr_code_path);
        }

        $plant->delete();

        return redirect()->route('admin.plants.index')->with('success', 'Data tumbuhan berhasil dihapus.');
    }

    // Fitur khusus untuk halaman cetak label QR Code siap tempel di pohon
    public function printLabel(Plant $plant)
    {
        return view('admin.plants.print-label', compact('plant'));
    }

    // --- FITUR CETAK WORD SESUAI ACTIVITY DIAGRAM ---

    // 1. Menyusun Data & Menampilkan Halaman Link Unduh
    public function exportReady($type, $id = null)
    {
        $plant = $id ? Plant::findOrFail($id) : null;
        return view('admin.plants.export_ready', compact('type', 'plant'));
    }

   // 2. Proses Konfirmasi (Insert Database) & Mengunduh File (Google Docs / Docx Asli)
    public function exportDownload($type, $id = null)
    {
        // Inisialisasi PhpWord
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        if ($type === 'all') {
            $plants = \App\Models\Plant::all();
            $filename = "Laporan_Semua_Data_Tumbuhan_Soraya.docx"; // Format asli .docx
            
            $section = $phpWord->addSection();
            
            // Judul
            $section->addText('DATA KESELURUHAN TUMBUHAN', ['bold' => true, 'size' => 14, 'color' => '166534'], ['alignment' => 'center']);
            $section->addText('STASIUN PENELITIAN SORAYA', ['bold' => true, 'size' => 12], ['alignment' => 'center']);
            $section->addTextBreak(1);

            // Setup Tabel
            $tableStyle = ['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80];
            $phpWord->addTableStyle('TabelData', $tableStyle);
            $table = $section->addTable('TabelData');

            // Header Tabel
            $table->addRow();
            $table->addCell(500)->addText('No', ['bold' => true]);
            $table->addCell(2000)->addText('Kode ID', ['bold' => true]);
            $table->addCell(3500)->addText('Nama Tumbuhan', ['bold' => true]);
            $table->addCell(3500)->addText('Nama Latin', ['bold' => true]);
            $table->addCell(2000)->addText('Famili', ['bold' => true]);
            $table->addCell(3000)->addText('Deskripsi', ['bold' => true]);
            // Isi Tabel
            foreach ($plants as $index => $p) {
                $table->addRow();
                $table->addCell(500)->addText($index + 1);
                $table->addCell(2000)->addText($p->kode_tumbuhan);
                $table->addCell(3500)->addText($p->nama_tumbuhan, ['bold' => true]);
                $table->addCell(3500)->addText($p->nama_latin, ['italic' => true]);
                $table->addCell(2000)->addText($p->famili ?? '-');
                $table->addCell(3000)->addText($p->deskripsi ?? '-'); // Kolom Deskripsi
            }
        } else {
            $plant = \App\Models\Plant::findOrFail($id);
            $filename = "Label_QR_" . str_replace(' ', '_', $plant->nama_tumbuhan) . ".docx";
            
            // HALAMAN 1: INFORMASI TUMBUHAN
            $section = $phpWord->addSection();
            
            $section->addText('STASIUN PENELITIAN SORAYA', ['bold' => true, 'size' => 16, 'color' => '166534'], ['alignment' => 'center']);
            $section->addText('KAWASAN EKOSISTEM LEUSER', ['bold' => true, 'size' => 10], ['alignment' => 'center']);
            $section->addTextBreak(1);
            
            $section->addText($plant->nama_tumbuhan, ['bold' => true, 'size' => 18], ['alignment' => 'center']);
            $section->addText($plant->nama_latin, ['italic' => true, 'size' => 14, 'color' => '15803d'], ['alignment' => 'center']);
            $section->addTextBreak(2);

            $tableStyle = ['cellMargin' => 80];
            $phpWord->addTableStyle('TableInfo', $tableStyle);
            $table = $section->addTable('TableInfo');
            
            $table->addRow();
            $table->addCell(2500)->addText('Kode ID', ['bold' => true]);
            $table->addCell(7500)->addText(': ' . $plant->kode_tumbuhan);
            
            $table->addRow();
            $table->addCell(2500)->addText('Famili Suku', ['bold' => true]);
            $table->addCell(7500)->addText(': ' . ($plant->famili ?? '-'));
            
            $table->addRow();
            $table->addCell(2500)->addText('Deskripsi', ['bold' => true]);
            $table->addCell(7500)->addText(': ' . $plant->deskripsi);

            // HALAMAN 2: QR CODE
            $section->addPageBreak(); // Memaksa pindah halaman di Docx
            
            $section->addText('QR CODE IDENTIFIKASI', ['bold' => true, 'size' => 16, 'color' => '166534'], ['alignment' => 'center']);
            $section->addText('Arahkan kamera smartphone ke QR Code ini untuk melihat informasi digital tumbuhan.', [], ['alignment' => 'center']);
            $section->addTextBreak(1);

            // Ambil gambar format PNG murni agar 100% kompatibel dengan Word & Google Docs
            $urlDetail = route('plant.detail', $plant->kode_tumbuhan);
            $qrApiUrl = "https://api.qrserver.com/v1/create-qr-code/?size=400x400&format=png&data=" . urlencode($urlDetail);
            
            try {
                // Bypass SSL lokal dan unduh gambar
                $response = \Illuminate\Support\Facades\Http::withoutVerifying()->timeout(10)->get($qrApiUrl);
                if ($response->successful()) {
                    // Menanamkan gambar langsung ke dalam dokumen (Embed)
                    $section->addImage($response->body(), [
                        'width' => 250,
                        'height' => 250,
                        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
                    ]);
                }
            } catch (\Exception $e) {
                 $section->addText('[Gagal memuat QR Code]', ['color' => 'FF0000'], ['alignment' => 'center']);
            }
            
            $section->addTextBreak(1);
            $section->addText('ID: ' . $plant->kode_tumbuhan, ['bold' => true, 'name' => 'Courier New'], ['alignment' => 'center']);
        }

        // Proses Penyimpanan Sementara & Pengunduhan
        $tempFile = tempnam(sys_get_temp_dir(), 'Docx');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        // Hapus file sementara setelah berhasil terunduh
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
}