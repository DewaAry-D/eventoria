<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tinjau Event: ') }} {{ $event->nama_event }}
            </h2>
            <a href="{{ route('admin.event.index') }}" class="text-sm px-4 py-2 bg-white border rounded-md shadow-sm">&larr; Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-6">
            
            <div class="w-full lg:w-2/3 bg-white shadow-sm sm:rounded-lg p-6">
                
                <div class="flex flex-col md:flex-row gap-6 mb-8 pb-6 border-b">
                    <div class="w-full md:w-1/3">
                        @if($event->flyer_url)
                            <img src="{{ asset('storage/' . $event->flyer_url) }}" alt="Poster" class="w-full rounded-lg shadow-md object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">Tanpa Poster</div>
                        @endif
                    </div>
                    <div class="w-full md:w-2/3">
                        <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-md text-xs font-bold">{{ $event->kategori->nama_kategori }}</span>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2 mb-1">{{ $event->nama_event }}</h3>
                        <p class="text-sm text-gray-500 mb-4">Diselenggarakan oleh: <strong>{{ $event->penyelenggara }}</strong></p>
                        
                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <span class="block text-gray-500 font-semibold">Kuota Peserta:</span>
                                <span>{{ $event->kuota }} Orang</span>
                            </div>
                            <div>
                                <span class="block text-gray-500 font-semibold">Lokasi:</span>
                                <span>{{ $event->nama_lokasi }}</span>
                                @if($event->lokasi_url)
                                    <a href="{{ $event->lokasi_url }}" target="_blank" class="text-indigo-600 hover:underline block text-xs">(Buka Maps)</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8 pb-6 border-b">
                    <h4 class="text-lg font-bold mb-2">Deskripsi Event</h4>
                    <p class="text-gray-700 whitespace-pre-line">{{ $event->deskripsi }}</p>
                    
                    @if($event->narasumber)
                        <h4 class="text-lg font-bold mt-4 mb-2">Narasumber</h4>
                        <p class="text-gray-700 whitespace-pre-line">{{ $event->narasumber }}</p>
                    @endif
                </div>

                <div class="mb-8 pb-6 border-b">
                    <h4 class="text-lg font-bold mb-4">Rangkaian Acara (Timeline)</h4>
                    @if($event->timelines->count() > 0)
                        <div class="space-y-4">
                            @foreach($event->timelines as $timeline)
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <h5 class="font-bold text-indigo-700">{{ $timeline->nama_timeline }}</h5>
                                    <p class="text-sm text-gray-500 mb-2">
                                        {{ \Carbon\Carbon::parse($timeline->tanggal_mulai)->format('d M Y, H:i') }} - 
                                        {{ \Carbon\Carbon::parse($timeline->tanggal_selesai)->format('d M Y, H:i') }}
                                    </p>
                                    @if($timeline->deskripsi_timeline)
                                        <p class="text-sm text-gray-700">{{ $timeline->deskripsi_timeline }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">Tidak ada timeline terdaftar.</p>
                    @endif
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4">Informasi Biaya Tiket</h4>
                    @if($event->biayaEvents->count() > 0)
                        <table class="min-w-full text-left text-sm text-gray-700">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-2 rounded-l-md">Kategori Tiket</th>
                                    <th class="p-2 rounded-r-md">Harga (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->biayaEvents as $biaya)
                                    <tr class="border-b">
                                        <td class="p-2">{{ $biaya->kategori }}</td>
                                        <td class="p-2 font-mono">Rp {{ number_format($biaya->biaya, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500 italic">Event ini bersifat gratis.</p>
                    @endif
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-white shadow-sm sm:rounded-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Keputusan Admin</h3>
                    
                    @if($event->status === 'ditolak' && $event->pesan_ditolak)
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-md">
                            <span class="block text-xs font-bold text-red-800 uppercase mb-1">Catatan Penolakan:</span>
                            <p class="text-sm text-red-700">{{ $event->pesan_ditolak }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-3 text-sm text-red-800 bg-red-100 rounded-lg">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.event.update-status', $event->id) }}" method="POST" x-data="{ status: '{{ $event->status }}' }">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tentukan Status</label>
                            <select name="status" x-model="status" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500">
                                <option value="pending">⏳ Pending (Menunggu)</option>
                                <option value="diterima">✅ Terima (Bisa Dilihat Mahasiswa)</option>
                                <option value="ditolak">❌ Tolak Event</option>
                            </select>
                        </div>

                        <div class="mb-4" x-show="status === 'ditolak'" style="display: none;">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Ditolak <span class="text-red-500">*</span></label>
                            <textarea name="pesan_ditolak" rows="3" placeholder="Masukkan alasan penolakan..." class="w-full border-gray-300 rounded-lg focus:ring-red-500">{{ old('pesan_ditolak', $event->pesan_ditolak) }}</textarea>
                        </div>

                        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 font-bold py-2 px-4 rounded-lg transition-colors">
                            Simpan Keputusan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>