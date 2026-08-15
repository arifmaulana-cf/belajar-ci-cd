<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';
    protected $primaryKey = 'id_qr';

    protected $fillable = [
        'id_tumbuhan',      //[cite: 1]
        'kode_qr',          //[cite: 1]
        'tanggal_generate', //[cite: 1]
    ];

    public function tumbuhan()
    {
        return $this->belongsTo(Tumbuhan::class, 'id_tumbuhan', 'id_tumbuhan');
    }
}