<?php

namespace App\Http\Controllers\Organisasi;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TemplateSertifikat;
use App\Models\PenerimaSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    public function index(Event $event)
    {
        if ($event->organisasi_id !== Auth::user()->organisasi->id) {
            abort(403);
        }

        $template = TemplateSertifikat::firstOrCreate(
            ['event_id' => $event->id],
            [
                'posisi_x' => 50, 
                'posisi_y' => 45, 
                'jenis_font' => 'Poppins', 
                'ukuran_font' => 32,
                'warna_font' => '#000000'
            ]
        );

        $peserta = PenerimaSertifikat::where('event_id', $event->id)->get();

        return view('organisasi.event.sertifikat', compact('event', 'template', 'peserta'));
    }

    public function updateTemplate(Request $request, Event $event)
    {
        if ($event->organisasi_id !== Auth::user()->organisasi->id) abort(403);

        $request->validate([
            'file_template' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'posisi_x'      => 'required|numeric',
            'posisi_y'      => 'required|numeric',
            'jenis_font'    => 'required|string',
            'ukuran_font'   => 'required|integer', // Pastikan integer
            'warna_font'    => 'required|string',
        ]);

        $template = TemplateSertifikat::where('event_id', $event->id)->first();
        $bgPath = $template->file_template;

        if ($request->hasFile('file_template')) {
            if ($bgPath && Storage::disk('public')->exists($bgPath)) {
                Storage::disk('public')->delete($bgPath);
            }
            $bgPath = $request->file('file_template')->store('sertifikat', 'public');
        }

        $template->update([
            'file_template' => $bgPath,
            'posisi_x'      => $request->posisi_x,
            'posisi_y'      => $request->posisi_y,
            'jenis_font'    => $request->jenis_font,
            'ukuran_font'   => $request->ukuran_font,
            'warna_font'    => $request->warna_font,
        ]);

        return back()->with('success', 'Template sertifikat berhasil disimpan!');
    }

    public function importPeserta(Request $request, Event $event)
    {
        $request->validate(['file_csv' => 'required|mimes:csv,txt|max:2048']);

        $file = $request->file('file_csv');
        $handle = fopen($file->path(), 'r');
        
        fgetcsv($handle, 1000, ','); // Skip baris header CSV

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if (isset($row[0]) && isset($row[1])) {
                PenerimaSertifikat::create([
                    'event_id'     => $event->id,
                    'nama_peserta' => trim($row[0]),
                    'email'        => trim($row[1])
                ]);
            }
        }
        fclose($handle);

        return back()->with('success', 'Data peserta berhasil diimpor!');
    }
}