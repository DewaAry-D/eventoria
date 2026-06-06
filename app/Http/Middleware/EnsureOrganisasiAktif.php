<?php

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