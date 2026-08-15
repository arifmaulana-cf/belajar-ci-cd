<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
        $plants = [
            [
                'kode_tumbuhan' => 'TMB-SOR-001',
                'nama_tumbuhan' => 'Pohon Keruing',
                'nama_latin'    => 'Dipterocarpus spp.',
                'famili'        => 'Dipterocarpaceae',
                'deskripsi'     => 'Spesies pohon kanopi dominan di Stasiun Penelitian Soraya. Memiliki kayu keras dan bernilai ekologis tinggi untuk habitat satwa liar Kawasan Ekosistem Leuser.',
                
            ],
            [
                'kode_tumbuhan' => 'TMB-SOR-002',
                'nama_tumbuhan' => 'Meranti Merah',
                'nama_latin'    => 'Shorea leprosula',
                'famili'        => 'Dipterocarpaceae',
                'deskripsi'     => 'Salah satu pohon komersial penting yang tumbuh di hutan dataran rendah Soraya. Memiliki ciri khas pepagan luar berwarna cokelat kemerahan.',
                
            ]
        ];

        foreach ($plants as $data) {
            // Generate QR Code otomatis untuk Seeder
            $scanUrl = route('plant.detail', $data['kode_tumbuhan']);
            $qrPath = 'qrcodes/qr-' . $data['kode_tumbuhan'] . '.svg';
            
            $qrCode = QrCode::format('svg')->size(300)->generate($scanUrl);
            Storage::disk('public')->put($qrPath, $qrCode);

            Plant::create(array_merge($data, [
                'gambar' => 'plants-images/sample.jpg',
                'qr_code_path' => $qrPath
            ]));
        }
    }
}