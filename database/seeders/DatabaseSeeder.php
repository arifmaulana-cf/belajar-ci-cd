<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin utama untuk sistem DigiFlora
        User::create([
            'name' => 'Admin Soraya',
            'email' => 'admin@digiflora.com',
            'password' => bcrypt('password123'),
        ]);
    }
}