<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganisasiMahasiswa;
use Illuminate\Http\Request;

class OrganisasiValidationController extends Controller
{
    public function index()
    {
        $organisasi = OrganisasiMahasiswa::with('fakultas')->latest()->paginate(10);
        return view('admin.organisasi.index', compact('organisasi'));
    }

    public function show(OrganisasiMahasiswa $organisasi)
    {
        $organisasi->load(['fakultas', 'user']);
        return view('admin.organisasi.show', compact('organisasi'));
    }

    public function updateStatus(Request $request, OrganisasiMahasiswa $organisasi)
    {
        $request->validate([
            'status' => 'required|in:pending,aktif,ditolak',
            'pesan_penolakan' => 'required_if:status,ditolak|nullable|string|max:1000'
        ], [
            'pesan_penolakan.required_if' => 'Alasan penolakan wajib diisi jika Anda menolak organisasi ini.'
        ]);

        $organisasi->update([
            'status' => $request->status,
            'pesan_penolakan' => $request->status === 'ditolak' ? $request->pesan_penolakan : null
        ]);

        return back()->with('success', "Status organisasi {$organisasi->nama_organisasi} berhasil diubah menjadi " . strtoupper($request->status));
    }
}