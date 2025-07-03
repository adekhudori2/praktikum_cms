<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        
        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nim', 'LIKE', "%{$search}%")
                  ->orWhere('jurusan', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        
        $mahasiswas = $query->orderBy('nama', 'asc')->paginate(10);
        
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        // Validasi input saat pendaftaran mahasiswa
        $validated = $request->validate([
            'username' => 'required|unique:mahasiswas,username',
            'password' => 'required|min:6',
            'nim' => 'required|unique:mahasiswas,nim|max:10',
            'nama' => 'required|max:255',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswas,email',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $fotoPath = null;
        
        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            $filename = time().'_'.Str::slug($request->nim).'.'.$request->foto->extension();
            $path = $request->foto->storeAs('uploads', $filename, 'public');
            $fotoPath = $filename;
        }

        // Simpan data mahasiswa
        Mahasiswa::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'foto' => $fotoPath,
            'role' => 'mahasiswa', // Set default role
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
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
        
        // Validasi input saat update data mahasiswa
        $validated = $request->validate([
            'nim' => 'required|max:10|unique:mahasiswas,nim,'.$id,
            'nama' => 'required|max:255',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,'.$id,
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Proses upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->foto) {
                Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
            }
            $filename = time().'_'.Str::slug($request->nim).'.'.$request->foto->extension();
            $path = $request->foto->storeAs('uploads', $filename, 'public');
            $mahasiswa->foto = $filename;
        }
        
        // Handle hapus foto jika diminta
        if ($request->has('hapus_foto') && $request->hapus_foto && $mahasiswa->foto) {
            Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
            $mahasiswa->foto = null;
        }
        // Update field lainnya
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->email = $request->email;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->save();

        // Redirect sesuai role
        if (auth()->guard('web')->check() && auth()->guard('web')->user()->role === 'admin') {
            // Jika admin, redirect ke daftar mahasiswa
            return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
        } else {
            // Jika mahasiswa, redirect ke dashboard mahasiswa
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Data berhasil diperbarui!');
        }
    }

    public function delete($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.delete', compact('mahasiswa'));
    }

    public function destroy($id)
    {
        // Validasi: pastikan data mahasiswa ada
        $mahasiswa = Mahasiswa::findOrFail($id);
        // Hapus foto jika ada
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
        }
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
    public function dashboard()
    {
        // Ambil data mahasiswa yang sedang login
        $mahasiswa = auth()->guard('mahasiswa')->user();

        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }

    public function editProfile()
    {
        // Ambil data mahasiswa yang sedang login
        $mahasiswa = auth()->guard('mahasiswa')->user();
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function updateProfile(Request $request)
    {
        $mahasiswa = auth()->guard('mahasiswa')->user();
        
        // Validasi input saat update data mahasiswa
        $validated = $request->validate([
            'nim' => 'required|max:10|unique:mahasiswas,nim,'.$mahasiswa->id,
            'nama' => 'required|max:255',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,'.$mahasiswa->id,
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Proses upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->foto) {
                Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
            }
            $filename = time().'_'.Str::slug($request->nim).'.'.$request->foto->extension();
            $path = $request->foto->storeAs('uploads', $filename, 'public');
            $mahasiswa->foto = $filename;
        }
        
        // Handle hapus foto jika diminta
        if ($request->has('hapus_foto') && $request->hapus_foto && $mahasiswa->foto) {
            Storage::disk('public')->delete('uploads/'.$mahasiswa->foto);
            $mahasiswa->foto = null;
        }
        // Update field lainnya
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->email = $request->email;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->save();

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Data berhasil diperbarui!');
    }
}