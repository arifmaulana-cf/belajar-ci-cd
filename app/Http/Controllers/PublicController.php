<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Halaman Beranda (Home)
    public function index()
    {
        $latestPlants = Plant::latest()->take(3)->get();
        return view('public.home', compact('latestPlants'));
    }

    // Halaman Galeri Tumbuhan
    public function gallery()
    {
        $plants = Plant::latest()->paginate(10);
        return view('public.gallery', compact('plants'));
    }

    // Halaman Scan QR Code
    public function scan()
    {
        return view('public.scan');
    }

    // halaman tentang kami
   public function tentang()
    {
        return view('public.tentang');
    }


    // Detail Tumbuhan Hasil Scan QR / Klik Galeri
    public function show($kode_tumbuhan)
    {
        $plant = Plant::where('kode_tumbuhan', $kode_tumbuhan)->firstOrFail();
        return view('public.plant-detail', compact('plant'));
    }
}