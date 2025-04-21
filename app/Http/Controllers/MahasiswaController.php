<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    private function initializeData()
    {
        if (!Session::has('mahasiswas')) {
            Session::put('mahasiswas', [
                [
                    'nim' => '2023001',
                    'nama' => 'Budi Santoso',
                    'jurusan' => 'Teknik Informatika',
                    'email' => 'budi@example.com',
                    'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                    'created_at' => Carbon::now()->format('d-m-Y H:i:s')
                ],
                [
                    'nim' => '2023002',
                    'nama' => 'Siti Nurhaliza',
                    'jurusan' => 'Sistem Informasi',
                    'email' => 'siti@example.com',
                    'alamat' => 'Jl. Veteran No. 5, Bandung',
                    'created_at' => Carbon::now()->format('d-m-Y H:i:s')
                ],
                [
                    'nim' => '2023003',
                    'nama' => 'Agus Wijaya',
                    'jurusan' => 'Teknik Komputer',
                    'email' => 'agus@example.com',
                    'alamat' => 'Jl. Gatot Subroto No. 15, Surabaya',
                    'created_at' => Carbon::now()->format('d-m-Y H:i:s')
                ],
            ]);
        }
    }

    public function index()
    {
        $this->initializeData();
        $mahasiswas = Session::get('mahasiswas');
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|max:10',
            'nama' => 'required|max:255',
            'jurusan' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);

        $this->initializeData();
        $mahasiswas = Session::get('mahasiswas');
        
        // Cek apakah NIM atau email sudah digunakan
        foreach ($mahasiswas as $mahasiswa) {
            if ($mahasiswa['nim'] == $request->nim) {
                return back()->withErrors(['nim' => 'NIM sudah digunakan'])->withInput();
            }
            if ($mahasiswa['email'] == $request->email) {
                return back()->withErrors(['email' => 'Email sudah digunakan'])->withInput();
            }
        }

        $mahasiswa = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'created_at' => Carbon::now()->format('d-m-Y H:i:s')
        ];

        $mahasiswas[] = $mahasiswa;
        Session::put('mahasiswas', $mahasiswas);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        $this->initializeData();
        $mahasiswas = Session::get('mahasiswas');
        
        if (!isset($mahasiswas[$id])) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Data mahasiswa tidak ditemukan!');
        }
        
        $mahasiswa = $mahasiswas[$id];
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $this->initializeData();
        $mahasiswas = Session::get('mahasiswas');
        
        if (!isset($mahasiswas[$id])) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Data mahasiswa tidak ditemukan!');
        }
        
        $mahasiswa = $mahasiswas[$id];
        $index = $id;
        return view('mahasiswa.edit', compact('mahasiswa', 'index'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|max:10',
            'nama' => 'required|max:255',
            'jurusan' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);

        $this->initializeData();
        $mahasiswas = Session::get('mahasiswas');
        
        if (!isset($mahasiswas[$id])) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Data mahasiswa tidak ditemukan!');
        }
        
        // Cek apakah NIM atau email sudah digunakan oleh mahasiswa lain
        foreach ($mahasiswas as $index => $mahasiswa) {
            if ($index != $id) {
                if ($mahasiswa['nim'] == $request->nim) {
                    return back()->withErrors(['nim' => 'NIM sudah digunakan'])->withInput();
                }
                if ($mahasiswa['email'] == $request->email) {
                    return back()->withErrors(['email' => 'Email sudah digunakan'])->withInput();
                }
            }
        }

        $mahasiswas[$id] = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'created_at' => $mahasiswas[$id]['created_at']
        ];
        
        Session::put('mahasiswas', $mahasiswas);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->initializeData();
        $mahasiswas = Session::get('mahasiswas');
        
        if (!isset($mahasiswas[$id])) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Data mahasiswa tidak ditemukan!');
        }
        
        $mahasiswa = $mahasiswas[$id];
        $index = $id;
        return view('mahasiswa.delete', compact('mahasiswa', 'index'));
    }

    public function destroy($id)
    {
        $this->initializeData();
        $mahasiswas = Session::get('mahasiswas');
        
        if (!isset($mahasiswas[$id])) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Data mahasiswa tidak ditemukan!');
        }
        
        unset($mahasiswas[$id]);
        $mahasiswas = array_values($mahasiswas); // Menata ulang indeks array
        Session::put('mahasiswas', $mahasiswas);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}