<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventValidationController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['organisasi', 'kategori'])->latest();

        $query->when($request->search, function ($q, $search) {
            $q->where('nama_event', 'like', "%{$search}%")
                ->orWhere('penyelenggara', 'like', "%{$search}%");
        });

        $query->when($request->kategori, function ($q, $kategori) {
            $q->where('kategori_id', $kategori);
        });

        $query->when($request->status, function ($q, $status) {
            $q->where('status', $status);
        });

        $events = $query->paginate(10)->appends($request->query());
        $kategoriList = Kategori::all();

        return view('admin.event.index', compact('events', 'kategoriList'));
    }

    public function show(Event $event)
    {
        $event->load(['organisasi', 'kategori', 'timelines', 'biayaEvents']);
        return view('admin.event.show', compact('event'));
    }

    public function updateStatus(Request $request, Event $event)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
            'pesan_ditolak' => 'required_if:status,ditolak|nullable|string|max:255'
        ], [
            'pesan_ditolak.required_if' => 'Alasan penolakan wajib diisi jika event ditolak.'
        ]);

        $event->update([
            'status' => $request->status,
            'pesan_ditolak' => $request->status === 'ditolak' ? $request->pesan_ditolak : null,
            'admin_acc_id' => Auth::user()->adminKampus?->id
        ]);

        return back()->with('success', "Status Event '{$event->nama_event}' berhasil diperbarui menjadi " . strtoupper($request->status));
    }
}