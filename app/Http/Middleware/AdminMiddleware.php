<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        
        // Jika admin, izinkan akses ke fitur admin
        if ($user->role === 'admin') {
            $routeName = $request->route()->getName();
            
            // Daftar route yang boleh diakses admin
            $allowedAdminRoutes = [
                'admin.dashboard',
                'mahasiswa.index',
                'mahasiswa.create',
                'mahasiswa.store',
                'mahasiswa.show',
                'mahasiswa.edit',
                'mahasiswa.update',
                'mahasiswa.delete',
                'mahasiswa.destroy'
            ];
            
            // Jika route yang diizinkan untuk admin
            if (in_array($routeName, $allowedAdminRoutes)) {
                return $next($request);
            }
            
            // Jika admin mencoba akses route mahasiswa, redirect ke dashboard admin
            if (in_array($routeName, ['mahasiswa.dashboard', 'mahasiswa.profile.edit', 'mahasiswa.profile.update'])) {
                return redirect()->route('admin.dashboard')->with('error', 'Admin tidak bisa mengakses fitur mahasiswa.');
            }
            
            // Default: akses ditolak, redirect ke dashboard admin
            return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak.');
        }
        
        // Jika bukan admin, redirect ke dashboard sesuai role
        if ($user->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Akses ditolak. Hanya admin yang bisa mengakses halaman ini.');
        }
        
        // Jika role tidak dikenali, redirect ke login
        return redirect('/login');
    }
}