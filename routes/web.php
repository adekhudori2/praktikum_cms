<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);

// Route untuk data sampel (opsional)
Route::get('/seed-sample', function() {
    $sampleData = [
        [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'nim' => '123456789',
            'program_studi' => 'Teknik Informatika',
            'fakultas' => 'FTI',
            'alamat' => 'Jl. Contoh No. 123',
            'telepon' => '08123456789'
        ],
        [
            'nama' => 'Jane Smith',
            'email' => 'jane@example.com',
            'nim' => '987654321',
            'program_studi' => 'Sistem Informasi',
            'fakultas' => 'FTI',
            'alamat' => 'Jl. Sample No. 456',
            'telepon' => '08987654321'
        ]
    ];

    foreach ($sampleData as $data) {
        App\Models\User::create($data);
    }

    return redirect()->route('users.index')
        ->with('success', 'Data sampel berhasil ditambahkan!');
});