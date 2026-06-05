<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOrganisasiAktif
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login, rolenya organisasi, dan statusnya aktif
        if ($request->user() && $request->user()->role === 'organisasi') {
            
            // Menggunakan nullsafe operator (?->) untuk mencegah error jika profil belum ada
            if ($request->user()->organisasi?->status !== 'aktif') {
                
                // Jika masih pending atau ditolak, tendang kembali ke dashboard
                // dengan membawa pesan error
                return redirect()->route('organisasi.dashboard')
                    ->with('error', 'Akun organisasi Anda masih dalam tahap peninjauan oleh Admin Kampus. Anda belum dapat membuat Event.');
            }
        }

        // Jika statusnya aktif, persilakan lewat
        return $next($request);
    }
}<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOrganisasiAktif
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === 'organisasi') {
            
            if ($request->user()->organisasi?->status !== 'aktif') {
                return redirect()->route('organisasi.dashboard')
                    ->with('error', 'Akun organisasi Anda masih dalam tahap peninjauan oleh Admin Kampus. Anda belum dapat membuat Event.');
            }
        }

        return $next($request);
    }
}