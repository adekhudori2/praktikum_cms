<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    public function handle($request, Closure $next)
    {
        // Cek apakah user sudah login di salah satu guard
        $user = null;
        $guard = null;
        
        if (auth()->guard('web')->check()) {
            $user = auth()->guard('web')->user();
            $guard = 'web';
        } elseif (auth()->guard('mahasiswa')->check()) {
            $user = auth()->guard('mahasiswa')->user();
            $guard = 'mahasiswa';
        }
        
        // Jika tidak ada user yang login
        if (!$user) {
            return redirect('/login');
        }
        
        // Jika admin, izinkan semua akses
        if ($user->role === 'admin') {
            return $next($request);
        }
        
        // Jika mahasiswa, batasi akses
        if ($user->role === 'mahasiswa') {
            $routeName = $request->route()->getName();
            $userId = $user->id;
            
            // Route yang boleh diakses mahasiswa
            $allowedMahasiswaRoutes = [
                'mahasiswa.dashboard',
                'mahasiswa.profile.edit',
                'mahasiswa.profile.update'
            ];
            
            // Jika route yang diizinkan untuk mahasiswa
            if (in_array($routeName, $allowedMahasiswaRoutes)) {
                return $next($request);
            }
            
            // Jika mahasiswa mencoba akses route admin, redirect ke dashboard mahasiswa
            if (in_array($routeName, ['mahasiswa.index', 'mahasiswa.create', 'mahasiswa.show', 'mahasiswa.edit', 'mahasiswa.update', 'mahasiswa.delete', 'mahasiswa.destroy'])) {
                return redirect()->route('mahasiswa.dashboard')->with('error', 'Akses ditolak. Anda hanya bisa mengakses dashboard dan edit profil.');
            }
            
            // Default: izinkan akses (untuk route yang tidak spesifik)
            return $next($request);
        }
        
        // Jika role tidak dikenali, redirect ke login
        return redirect('/login');
    }
}
