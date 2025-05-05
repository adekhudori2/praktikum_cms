<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Fungsi "seolah-olah" mengambil dari database
public static function getAll()
{
    return Mahasiswa::all();
}

public static function find($id)
{
    return Mahasiswa::where($id)->first();
}

}