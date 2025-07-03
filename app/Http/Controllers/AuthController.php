<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required|in:mahasiswa,admin',
        ]);

        $credentials = $request->only('username', 'password');
        $selectedRole = $request->role;

        if ($selectedRole === 'admin') {
            if (Auth::guard('web')->attempt($credentials)) {
                $user = Auth::guard('web')->user();
                if ($user->role !== $selectedRole) {
                    Auth::guard('web')->logout();
                    return back()->withErrors([
                        'username' => 'Role yang dipilih tidak sesuai dengan akun Anda. Silakan pilih role yang benar.',
                    ])->withInput($request->only('username', 'role'));
                }
                // Regenerate session untuk keamanan
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            }
        } else {
        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            $user = Auth::guard('mahasiswa')->user();
                if ($user->role !== $selectedRole) {
                    Auth::guard('mahasiswa')->logout();
                    return back()->withErrors([
                        'username' => 'Role yang dipilih tidak sesuai dengan akun Anda. Silakan pilih role yang benar.',
                    ])->withInput($request->only('username', 'role'));
                }
                // Regenerate session untuk keamanan
                $request->session()->regenerate();
                return redirect()->route('mahasiswa.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '!');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username', 'role'));
    }

    public function logout(Request $request)
    {
        // Logout dari semua guard yang mungkin aktif
        Auth::guard('web')->logout();
        Auth::guard('mahasiswa')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
