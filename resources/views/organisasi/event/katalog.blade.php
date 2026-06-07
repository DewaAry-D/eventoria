<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pratinjau Katalog: ') }} {{ $event->nama_event }}
            </h2>
            <a href="{{ route('organisasi.event.index') }}" class="text-sm px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition font-semibold">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 p-4 rounded-lg border 
                @if($event->status === 'pending') bg-yellow-50 border-yellow-200 
                @elseif($event->status === 'diterima') bg-green-50 border-green-200 
                @else bg-red-50 border-red-200 @endif">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">
                        @if($event->status === 'pending') ⏳
                        @elseif($event->status === 'diterima') ✅
                        @else ❌ @endif
                    </span>
                    <div>
                        <h4 class="font-bold text-gray-900">Status Validasi Admin: <span class="uppercase">{{ $event->status }}</span></h4>
                        @if($event->status === 'pending')
                            <p class="text-sm text-yellow-800 mt-1">Event Anda sedang dalam antrean pemeriksaan oleh Admin Kampus.</p>
                        @elseif($event->status === 'diterima')
                            <p class="text-sm text-green-800 mt-1">Event Anda sudah tayang dan dapat dilihat oleh Mahasiswa.</p>
                        @elseif($event->status === 'ditolak')
                            <p class="text-sm text-red-800 mt-1">Mohon maaf, event Anda ditolak dengan alasan: <strong>{{ $event->pesan_ditolak }}</strong>. Silakan edit event ini untuk memperbaikinya.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden flex flex-col md:flex-row">
                
                <div class="w-full md:w-5/12 bg-gray-100 p-6 flex flex-col items-center border-r">
                    @if($event->flyer_url)
                        <img src="{{ asset('storage/' . $event->flyer_url) }}" alt="Poster Event" class="w-full max-w-sm rounded-lg shadow-md object-cover">
                    @else
                        <div class="w-full max-w-sm aspect-[3/4] bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 shadow-inner">
                            <span class="text-sm font-semibold">Tidak ada poster</span>
                        </div>
                    @endif
                    
                    <div class="mt-6 w-full max-w-sm space-y-4">
                        <a href="{{ $event->link_event }}" target="_blank" class="block w-full text-center px-4 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-sm transition">
                            Coba Buka Link Pendaftaran
                        </a>
                        
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Informasi Lokasi</span>
                            <span class="font-semibold text-gray-800 block">{{ $event->nama_lokasi }}</span>
                            @if($event->lokasi_url)
                                <a href="{{ $event->lokasi_url }}" target="_blank" class="text-indigo-600 text-sm hover:underline mt-1 inline-block">Buka di Google Maps &rarr;</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-7/12 p-8">
                    <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-bold mb-3">{{ $event->kategori->nama_kategori }}</span>
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $event->nama_event }}</h1>
                    <p class="text-gray-500 mb-6">Diselenggarakan oleh: <span class="font-semibold text-gray-700">{{ $event->penyelenggara }}</span></p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-gray-50 p-3 rounded-md border">
                            <span class="block text-xs text-gray-500 uppercase font-semibold">Total Kuota</span>
                            <span class="text-lg font-bold text-gray-900">{{ $event->kuota }} <span class="text-sm font-normal text-gray-500">Orang</span></span>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-md border">
                            <span class="block text-xs text-gray-500 uppercase font-semibold">Sisa Kuota Tersedia</span>
                            <span class="text-lg font-bold text-indigo-600">{{ $event->sisa_kuota }} <span class="text-sm font-normal text-gray-500">Orang</span></span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 border-b pb-2">Deskripsi Kegiatan</h3>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $event->deskripsi }}</p>
                    </div>

                    @if($event->narasumber)
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 border-b pb-2">Narasumber / Pembicara</h3>
                            <p class="text-gray-700 whitespace-pre-line">{{ $event->narasumber }}</p>
                        </div>
                    @endif

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Rangkaian Acara (Timeline)</h3>
                        @if($event->timelines->count() > 0)
                            <div class="relative border-l border-gray-200 ml-3 space-y-6">
                                @foreach($event->timelines as $index => $timeline)
                                    <div class="mb-8 ml-6">
                                        <span class="absolute flex items-center justify-center w-6 h-6 bg-indigo-100 rounded-full -left-3 ring-8 ring-white text-indigo-800 text-xs font-bold">
                                            {{ $index + 1 }}
                                        </span>
                                        <h4 class="mb-1 text-md font-bold text-gray-900">{{ $timeline->nama_timeline }}</h4>
                                        <time class="block mb-2 text-sm font-normal leading-none text-gray-500">
                                            {{ \Carbon\Carbon::parse($timeline->tanggal_mulai)->format('d M Y, H:i') }} WIB 
                                            <span class="mx-1">-</span> 
                                            {{ \Carbon\Carbon::parse($timeline->tanggal_selesai)->format('d M Y, H:i') }} WIB
                                        </time>
                                        @if($timeline->deskripsi_timeline)
                                            <p class="text-sm font-normal text-gray-600">{{ $timeline->deskripsi_timeline }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Timeline belum ditambahkan.</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Biaya Pendaftaran</h3>
                        @if($event->biayaEvents->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($event->biayaEvents as $biaya)
                                    <div class="flex justify-between items-center p-3 bg-indigo-50 border border-indigo-100 rounded-lg">
                                        <span class="font-medium text-indigo-900">{{ $biaya->kategori }}</span>
                                        <span class="font-bold text-indigo-700">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 border border-green-200 rounded-lg font-bold">
                                🆓 Event ini 100% Gratis!
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>