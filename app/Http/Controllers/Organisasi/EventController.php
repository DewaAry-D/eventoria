<?php

namespace App\Http\Controllers\Organisasi;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $organisasiId = Auth::user()->organisasi->id;
        $query = Event::with('kategori')->where('organisasi_id', $organisasiId)->latest();

        $query->when($request->search, function ($q, $search) {
            $q->where('nama_event', 'like', "%{$search}%");
        });

        $query->when($request->kategori, function ($q, $kategori) {
            $q->where('kategori_id', $kategori);
        });

        $query->when($request->status, function ($q, $status) {
            $q->where('status', $status);
        });

        $events = $query->paginate(10)->appends($request->query());
        $kategoriList = Kategori::all();

        return view('organisasi.event.index', compact('events', 'kategoriList'));
    }

    public function katalog(Event $event)
    {
        if ($event->organisasi_id !== Auth::user()->organisasi->id) {
            abort(403, 'Akses ditolak. Anda tidak diizinkan melihat event dari organisasi lain.');
        }

        $event->load(['kategori', 'timelines', 'biayaEvents']);

        return view('organisasi.event.katalog', compact('event'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('organisasi.event.create', compact('kategori'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event'   => 'required|string|max:255',
            'kategori_id'  => 'required|exists:kategori,id',
            'penyelenggara'=> 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'nama_lokasi'  => 'required|string|max:255',
            'lokasi_url'   => 'nullable|url|max:255',
            'kuota'        => 'required|integer|min:1',
            'narasumber'   => 'nullable|string',
            'link_event'   => 'required|url|max:255',
            'flyer_url'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            
            // Validasi Array Timelines (Minimal 1 timeline)
            'timelines' => 'required|array|min:1',
            'timelines.*.nama_timeline' => 'required|string|max:255',
            'timelines.*.deskripsi_timeline' => 'nullable|string',
            'timelines.*.tanggal_mulai' => 'required|date',
            'timelines.*.tanggal_selesai' => 'required|date|after_or_equal:timelines.*.tanggal_mulai',

            'biayas' => 'nullable|array',
            'biayas.*.kategori' => 'required_with:biayas|string|max:50',
            'biayas.*.biaya' => 'required_with:biayas|numeric|min:0',
        ]);

        $slug = Str::slug($request->nama_event) . '-' . Str::random(5);

        $flyerPath = null;
        if ($request->hasFile('flyer_url')) {
            $flyerPath = $request->file('flyer_url')->store('flyers', 'public');
        }

        DB::transaction(function () use ($request, $slug, $flyerPath) {
            
            // A. Simpan Event Induk
            $event = Event::create([
                'kategori_id'   => $request->kategori_id,
                'organisasi_id' => Auth::user()->organisasi->id,
                'nama_event'    => $request->nama_event,
                'slug'          => $slug,
                'penyelenggara' => $request->penyelenggara,
                'status'        => 'pending',
                'deskripsi'     => $request->deskripsi,
                'nama_lokasi'   => $request->nama_lokasi,
                'lokasi_url'    => $request->lokasi_url,
                'kuota'         => $request->kuota,
                'sisa_kuota'    => $request->kuota,
                'narasumber'    => $request->narasumber,
                'link_event'    => $request->link_event,
                'flyer_url'     => $flyerPath,
            ]);

            if ($request->has('timelines')) {
                $event->timelines()->createMany($request->timelines);
            }

            if ($request->has('biayas') && !empty($request->biayas[0]['kategori'])) {
                $event->biayaEvents()->createMany($request->biayas);
            }
        });

        return redirect()->route('organisasi.dashboard')->with('success', 'Event beserta susunan acara berhasil diajukan dan sedang menunggu validasi Admin Kampus.');
    }

    // Menampilkan form edit
    public function edit(Event $event)
    {
        if ($event->organisasi_id !== Auth::user()->organisasi->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit event ini.');
        }

        $event->load(['timelines', 'biayaEvents']);
        $kategori = Kategori::all();

        $formattedTimelines = $event->timelines->map(function($t) {
            return [
                'nama_timeline' => $t->nama_timeline,
                'tanggal_mulai' => \Carbon\Carbon::parse($t->tanggal_mulai)->format('Y-m-d\TH:i'),
                'tanggal_selesai' => \Carbon\Carbon::parse($t->tanggal_selesai)->format('Y-m-d\TH:i'),
                'deskripsi_timeline' => $t->deskripsi_timeline ?? '',
            ];
        });

        $formattedBiayas = $event->biayaEvents->map(function($b) {
            return [
                'kategori' => $b->kategori,
                'biaya' => $b->biaya,
            ];
        });

        return view('organisasi.event.edit', compact('event', 'kategori', 'formattedTimelines', 'formattedBiayas'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->organisasi_id !== Auth::user()->organisasi->id) {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'penyelenggara'=> 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'nama_lokasi'  => 'required|string|max:255',
            'lokasi_url'   => 'nullable|url|max:255',
            'kuota'        => 'required|integer|min:1',
            'narasumber'   => 'nullable|string',
            'link_event'   => 'required|url|max:255',
            'flyer_url'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            'timelines' => 'required|array|min:1',
            'timelines.*.nama_timeline' => 'required|string|max:255',
            'timelines.*.deskripsi_timeline' => 'nullable|string',
            'timelines.*.tanggal_mulai' => 'required|date',
            'timelines.*.tanggal_selesai' => 'required|date|after_or_equal:timelines.*.tanggal_mulai',

            'biayas' => 'nullable|array',
            'biayas.*.kategori' => 'required_with:biayas|string|max:50',
            'biayas.*.biaya' => 'required_with:biayas|numeric|min:0',
        ]);

        $flyerPath = $event->flyer_url;
        if ($request->hasFile('flyer_url')) {
            if ($flyerPath && Storage::disk('public')->exists($flyerPath)) {
                Storage::disk('public')->delete($flyerPath);
            }
            $flyerPath = $request->file('flyer_url')->store('flyers', 'public');
        }

        DB::transaction(function () use ($request, $event, $flyerPath) {
            
            $event->update([
                'kategori_id'   => $request->kategori_id,
                'penyelenggara' => $request->penyelenggara,
                'deskripsi'     => $request->deskripsi,
                'nama_lokasi'   => $request->nama_lokasi,
                'lokasi_url'    => $request->lokasi_url,
                'kuota'         => $request->kuota,
                'narasumber'    => $request->narasumber,
                'link_event'    => $request->link_event,
                'flyer_url'     => $flyerPath,
            ]);

            $event->timelines()->delete();
            if ($request->has('timelines')) {
                $event->timelines()->createMany($request->timelines);
            }

            $event->biayaEvents()->delete();
            if ($request->has('biayas') && !empty($request->biayas[0]['kategori'])) {
                $event->biayaEvents()->createMany($request->biayas);
            }
        });

        return redirect()->route('organisasi.event.index')->with('success', 'Detail Event berhasil diperbarui.');
    }
}