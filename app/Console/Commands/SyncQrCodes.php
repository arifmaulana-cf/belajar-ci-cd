<?php

namespace App\Console\Commands;

use App\Models\Plant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SyncQrCodes extends Command
{
    protected $signature = 'digiflora:sync-qr';

    protected $description = 'Regenerate QR codes for all plants using the current APP_URL';

    public function handle()
    {
        $count = 0;
        foreach (Plant::all() as $plant) {
            $url = route('plant.detail', $plant->kode_tumbuhan);
            $path = $plant->qr_code_path ?: ('qrcodes/qr-' . $plant->kode_tumbuhan . '.svg');
            $svg = QrCode::format('svg')->size(300)->generate($url);
            Storage::disk('public')->put($path, $svg);
            $plant->qr_code_path = $path;
            $plant->save();
            $count++;
        }

        $this->info("QR codes synced ({$count}) to " . config('app.url'));

        return self::SUCCESS;
    }
}
