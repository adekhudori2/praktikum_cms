<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::factory()->count(10)->create(); // buat 10 data
    
    
        // Admin
        Mahasiswa::create([
            'nim' => '0001',
            'nama' => 'Admin Satu',
            'jurusan' => 'Teknik Informatika',
            'email' => 'admin@example.com',
            'alamat' => 'Kampus A',
            'foto' => null,
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Mahasiswa
        Mahasiswa::create([
            'nim' => '1234',
            'nama' => 'Mahasiswa Satu',
            'jurusan' => 'Sistem Informasi',
            'email' => 'mahasiswa@example.com',
            'alamat' => 'Kampus B',
            'foto' => null,
            'username' => 'mahasiswa',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);
    }

}