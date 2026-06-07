<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\OrganisasiMahasiswa;
use Illuminate\Http\Request;

class OrganisasiValidationController extends Controller
{
    
    public function index(Request $request)
    {
        $query = OrganisasiMahasiswa::with('fakultas')->latest();

        $query->when($request->search, function ($q, $search) {
            $q->where('nama_organisasi', 'like', "%{$search}%")
                ->orWhere('no_organisasi', 'like', "%{$search}%");
        });

        $query->when($request->tingkat, function ($q, $tingkat) {
            $q->where('tingkat_organisasi', $tingkat);
        });

        $query->when($request->fakultas, function ($q, $fakultas) {
            $q->where('fakultas_id', $fakultas);
        });

        $query->when($request->status, function ($q, $status) {
            $q->where('status', $status);
        });

        $organisasi = $query->paginate(10)->appends($request->query());
        $fakultasList = Fakultas::all();

        return view('admin.organisasi.index', compact('organisasi', 'fakultasList'));
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