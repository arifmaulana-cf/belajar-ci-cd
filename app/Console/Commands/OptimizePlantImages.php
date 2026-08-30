<?php

namespace App\Console\Commands;

use App\Models\Plant;
use Illuminate\Console\Command;

class OptimizePlantImages extends Command
{
    protected $signature = 'plants:optimize-images
        {--max-dim=1400 : Maksimal sisi terpanjang (px)}
        {--quality=82 : Kualitas JPEG (0-100)}';

    protected $description = 'Resize & rekompresi gambar tanaman lokal agar loading web lebih cepat (pakai GD)';

    public function handle(): int
    {
        $maxDim  = (int) $this->option('max-dim');
        $quality = (int) $this->option('quality');

        $plants = Plant::whereNotNull('gambar')->get();
        $count = 0;
        $saved = 0;

        foreach ($plants as $plant) {
            // Lewati gambar berbasis URL eksternal
            if (filter_var($plant->gambar, FILTER_VALIDATE_URL)) {
                continue;
            }

            $path = storage_path('app/public/' . $plant->gambar);
            if (!file_exists($path)) {
                $this->warn("File tidak ditemukan: {$plant->gambar}");
                continue;
            }

            $info = @getimagesize($path);
            if (!$info) {
                continue;
            }

            $mime = $info['mime'];
            switch ($mime) {
                case 'image/jpeg':
                    $src = @imagecreatefromjpeg($path);
                    break;
                case 'image/png':
                    $src = @imagecreatefrompng($path);
                    break;
                case 'image/webp':
                    $src = @imagecreatefromwebp($path);
                    break;
                default:
                    break;
            }

            if (!$src) {
                continue;
            }

            $w = imagesx($src);
            $h = imagesy($src);
            $longest = max($w, $h);

            if ($longest > $maxDim) {
                $ratio = $maxDim / $longest;
                $nw = (int) round($w * $ratio);
                $nh = (int) round($h * $ratio);
            } else {
                $nw = $w;
                $nh = $h;
            }

            $dst = imagecreatetruecolor($nw, $nh);

            if ($mime === 'image/png' || $mime === 'image/webp') {
                imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
            }

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);

            $oldSize = filesize($path);
            $isAlpha = ($mime === 'image/png' || $mime === 'image/webp');

            if ($isAlpha) {
                // Konversi ke JPEG agar lebih kecil
                $newName = preg_replace('/\.(png|webp)$/i', '.jpg', $plant->gambar);
                $out = storage_path('app/public/' . $newName);
                imagejpeg($dst, $out, $quality);
                if ($newName !== $plant->gambar) {
                    @unlink($path);
                    $plant->gambar = $newName;
                    $plant->save();
                }
            } else {
                imagejpeg($dst, $path, $quality);
                $newName = $plant->gambar;
            }

            $newSize = filesize(storage_path('app/public/' . $newName));
            $saved += ($oldSize - $newSize);
            $count++;

            imagedestroy($src);
            imagedestroy($dst);

            $this->line("{$plant->kode_tumbuhan}: {$w}x{$h} -> {$nw}x{$nh}, " . round($oldSize / 1024) . "KB -> " . round($newSize / 1024) . "KB");
        }

        $this->info("Selesai. {$count} file dioptimasi, hemat " . round($saved / 1024 / 1024, 2) . " MB.");

        return 0;
    }
}
