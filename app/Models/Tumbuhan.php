<?php

namespace App\Models;
use App\Models\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tumbuhan extends Model
{
    use HasFactory;

    protected $table = 'tumbuhans';
    protected $primaryKey = 'id_tumbuhan';

    protected $fillable = [
        'nama_tumbuhan', //
        'nama_latin',    //
        'deskripsi',     //
        'habitat',       //
        'manfaat',       //
        'gambar',        //
    ];

    // Relasi 1-to-1 dengan QrCode[cite: 1]
    public function qrCode()
    {
        return $this->hasOne(QrCode::class, 'id_tumbuhan', 'id_tumbuhan');
    }
}

