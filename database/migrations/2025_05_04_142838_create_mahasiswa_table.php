<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('jurusan');
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role')->default('mahasiswa'); // admin / mahasiswa
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
        Schema::table('mahasiswa', function (Blueprint $table) {
    $table->string('foto')->nullable()->after('nim'); // contoh kolom untuk menyimpan nama file
});
    }
};