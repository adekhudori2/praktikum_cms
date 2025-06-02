<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|unique:mahasiswas,nim|max:10',
            'nama' => 'required|max:255',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswas,email',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('foto')) {
        // Generate nama file unik
        $filename = time().'_'.Str::slug($request->nim).'.'.$request->foto->extension();
        
        // Simpan file ke folder public/uploads
        $path = $request->foto->storeAs('uploads', $filename, 'public');
    }

        Mahasiswa::create([
        'nim' => $request->nim,
        'nama' => $request->nama,
        'jurusan' => $request->jurusan,
        'email' => $request->email,
        'alamat' => $request->alamat,
        'foto' => $filename ?? null, // simpan nama file
        // tambahkan field lainnya
    ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        $validated = $request->validate([
            'nim' => 'required|max:10|unique:mahasiswas,nim,'.$id,
            'nama' => 'required|max:255',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,'.$id,
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
         if ($request->hasFile('foto')) {
        // Hapus file lama jika ada
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
        }
        
        // Upload file baru
        $filename = time().'_'.Str::slug($request->nim).'.'.$request->foto->extension();
        $path = $request->foto->storeAs('uploads', $filename, 'public');
        $mahasiswa->foto = $filename;
    }
    
    // Handle hapus foto
    if ($request->hapus_foto && $mahasiswa->foto) {
        Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
        $mahasiswa->foto = null;
    }
    
    // Update field lainnya
    $mahasiswa->nim = $request->nim;
    // update field lainnya
    
    $mahasiswa->save();
    $mahasiswa->update($validated);
        

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function delete($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.delete', compact('mahasiswa'));
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
         if ($mahasiswa->foto) {
        Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
    }
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
   
}