<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Event Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('organisasi.event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Event</label>
                            <input type="text" name="nama_event" value="{{ old('nama_event') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('nama_event') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                            <input type="text" name="penyelenggara" value="{{ old('penyelenggara', Auth::user()->organisasi->nama_organisasi) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori Event</label>
                            <select name="kategori_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kuota Peserta</label>
                            <input type="number" name="kuota" value="{{ old('kuota') }}" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lokasi (Gedung/Ruangan)</label>
                            <input type="text" name="nama_lokasi" value="{{ old('nama_lokasi') }}" required placeholder="Contoh: Aula Nusantara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Link Google Maps (Opsional)</label>
                            <input type="url" name="lokasi_url" value="{{ old('lokasi_url') }}" placeholder="https://maps.app.goo.gl/..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Link Pendaftaran (Gform/Web)</label>
                            <input type="url" name="link_event" value="{{ old('link_event') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi Event</label>
                            <textarea name="deskripsi" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Narasumber / Pembicara (Opsional, jika pembicara lebih dari satu pisahkan dengan | tanpa spasi)</label>
                            <textarea name="narasumber" rows="2" placeholder="Sebutkan nama dan gelar pembicara jika ada..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('narasumber') }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Upload Poster / Flyer</label>
                            <input type="file" name="flyer_url" accept="image/jpeg, image/png, image/jpg" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal ukuran: 2MB.</p>
                            @error('flyer_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2 mt-8 pt-6 border-t" x-data="{ 
                        timelines: [{ nama_timeline: '', deskripsi_timeline: '', tanggal_mulai: '', tanggal_selesai: '' }] 
                    }">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-900">Susunan Acara (Timeline) <span class="text-red-500">*</span></h3>
                            <button type="button" @click="timelines.push({ nama_timeline: '', deskripsi_timeline: '', tanggal_mulai: '', tanggal_selesai: '' })" class="text-sm px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 font-semibold transition">
                                + Tambah Rangkaian
                            </button>
                        </div>

                        <template x-for="(item, index) in timelines" :key="index">
                            <div class="p-4 mb-4 border border-gray-200 rounded-lg bg-gray-50 relative">
                                
                                <button type="button" x-show="timelines.length > 1" @click="timelines.splice(index, 1)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Nama Agenda <span x-text="index + 1"></span></label>
                                        <input type="text" x-model="item.nama_timeline" :name="`timelines[${index}][nama_timeline]`" required placeholder="Contoh: Masa Pendaftaran / Hari H" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                        <input type="datetime-local" x-model="item.tanggal_mulai" :name="`timelines[${index}][tanggal_mulai]`" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                                        <input type="datetime-local" x-model="item.tanggal_selesai" :name="`timelines[${index}][tanggal_selesai]`" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                                        <textarea x-model="item.deskripsi_timeline" :name="`timelines[${index}][deskripsi_timeline]`" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                        <div class="md:col-span-2 mt-4 pt-6 border-t" x-data="{ 
                            biayas: [{ kategori: 'Gratis', biaya: 0 }] 
                        }">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Struktur Biaya Pendaftaran</h3>
                                <button type="button" @click="biayas.push({ kategori: '', biaya: '' })" class="text-sm px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 font-semibold transition">
                                    + Tambah Kategori Biaya
                                </button>
                            </div>
                            
                            <p class="text-xs text-gray-500 mb-4">Jika event gratis, biarkan kategori tetap 'Gratis' dengan biaya 0.</p>

                            <template x-for="(item, index) in biayas" :key="index">
                                <div class="flex gap-4 mb-3 items-start relative">
                                    <div class="flex-1">
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Kategori Tiket</label>
                                        <input type="text" x-model="item.kategori" :name="`biayas[${index}][kategori]`" placeholder="Contoh: Mahasiswa / Umum / VIP" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                                        <input type="number" x-model="item.biaya" :name="`biayas[${index}][biaya]`" min="0" placeholder="0" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    
                                    <button type="button" x-show="biayas.length > 1" @click="biayas.splice(index, 1)" class="mt-6 text-red-500 hover:text-red-700 p-2 bg-red-50 rounded-md">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 border-t pt-4">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ajukan Event
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>