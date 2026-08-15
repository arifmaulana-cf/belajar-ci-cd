<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_tumbuhan',
        'nama_tumbuhan',
        'nama_latin',
        'famili',
        'deskripsi',
        'gambar',
        'qr_code_path',
    ];
}