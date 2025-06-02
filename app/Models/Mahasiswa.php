<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'email',
        'alamat',
        'foto',
        // tambahkan field lain yang perlu diisi massal di sini
    ];

    // Fungsi "seolah-olah" mengambil dari database
    public static function getAll()
    {
        return self::all();
    }

    public static function find($id)
    {
        return self::find($id);
    }
}
