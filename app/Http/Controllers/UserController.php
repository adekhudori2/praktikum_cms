<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        if (User::exists('email', $validated['email'])) {
            return back()->withErrors(['email' => 'Email sudah digunakan'])->withInput();
        }

        if (User::exists('nim', $validated['nim'])) {
            return back()->withErrors(['nim' => 'NIM sudah digunakan'])->withInput();
        }

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Mahasiswa berhasil didaftarkan!');
    }

    public function show($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            abort(404);
        }

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            abort(404);
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRequest($request);

        if (User::exists('email', $validated['email'], $id)) {
            return back()->withErrors(['email' => 'Email sudah digunakan'])->withInput();
        }

        if (User::exists('nim', $validated['nim'], $id)) {
            return back()->withErrors(['nim' => 'NIM sudah digunakan'])->withInput();
        }

        User::update($id, $validated);

        return redirect()->route('users.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::delete($id);

        return redirect()->route('users.index')
            ->with('success', 'Mahasiswa berhasil dihapus!');
    }

    private function validateRequest($request)
    {
        return $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|max:100',
            'nim' => 'required|max:20',
            'program_studi' => 'required|max:50',
            'fakultas' => 'required|max:50',
            'alamat' => 'nullable',
            'telepon' => 'nullable|max:15'
        ]);
    }
}