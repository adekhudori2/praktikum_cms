<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Mahasiswa extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable;

    protected $table = 'mahasiswas';
    protected $guard = 'mahasiswa';

    protected $fillable = [
        'username',
        'password',
        'nim',
        'nama',
        'jurusan',
        'email',
        'alamat',
        'foto',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    // Fungsi untuk ambil semua data
    public static function getAll()
    {
        return self::all();
    }

    // Catatan: fungsi ini akan menimpa default find() Laravel
    // Jadi lebih baik jangan digunakan dengan nama `find`
    // Gunakan nama lain, misal:
    public static function findMahasiswa($id)
    {
        return self::find($id);
    }
}

