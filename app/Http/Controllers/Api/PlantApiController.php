<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantApiController extends Controller
{
    // Mengambil semua data tumbuhan
    public function index()
    {
        $plants = Plant::latest()->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data tumbuhan berhasil diambil',
            'data' => $plants
        ], 200);
    }

    // Mengambil detail tumbuhan berdasarkan Kode
    public function show($kode_tumbuhan)
    {
        $plant = Plant::where('kode_tumbuhan', $kode_tumbuhan)->first();

        if ($plant) {
            return response()->json([
                'status' => 'success',
                'message' => 'Detail tumbuhan ditemukan',
                'data' => $plant
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Data tumbuhan tidak ditemukan'
        ], 404);
    }
}