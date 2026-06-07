<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Organisasi') }}
            </h2>
            <a href="{{ route('admin.organisasi.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-6">
            
            <div class="w-full lg:w-2/3 bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-50 border-b items-center flex gap-4" >
                    <div class="">
                        @if($organisasi->logo_url)
                            <img class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-sm" src="{{ asset('storage/' . $organisasi->logo_url) }}" alt="Logo {{ $organisasi->nama_organisasi }}">
                        @else
                            <img class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($organisasi->nama_organisasi) }}&background=E0E7FF&color=4338CA&size=128" alt="Default Logo">
                        @endif
                    </div>
                    <div class="">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $organisasi->nama_organisasi }}</h3>
                        <p class="text-sm text-gray-500 font-mono mt-1">SK/Reg: {{ $organisasi->no_organisasi ?? 'Tidak ada data' }}</p>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-md font-bold text-gray-900 border-b pb-2 mb-4">Data Akademik & Sistem</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4 mb-8">
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email Login (User)</span>
                            <span class="text-gray-900">{{ $organisasi->user->email ?? 'Data User Tidak Ditemukan' }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tingkat Organisasi</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-blue-100 text-blue-800 capitalize">
                                {{ $organisasi->tingkat_organisasi ?? 'Belum diatur' }}
                            </span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Fakultas</span>
                            <span class="text-gray-900">{{ $organisasi->fakultas?->nama_fakultas ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Program Studi</span>
                            <span class="text-gray-900">{{ $organisasi->prodi ?? '-' }}</span>
                        </div>
                    </div>

                    <h4 class="text-md font-bold text-gray-900 border-b pb-2 mb-4">Jejaring Sosial (Tautan)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Instagram</span>
                            @if($organisasi->ig_url)
                                <a href="{{ $organisasi->ig_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                                    Buka Instagram
                                </a>
                            @else
                                <span class="text-gray-400 italic">Belum ditambahkan</span>
                            @endif
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">LinkedIn</span>
                            @if($organisasi->linkedin_url)
                                <a href="{{ $organisasi->linkedin_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" /></svg>
                                    Buka LinkedIn
                                </a>
                            @else
                                <span class="text-gray-400 italic">Belum ditambahkan</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-white shadow-sm sm:rounded-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Panel Validasi
                    </h3>
                    
                    <div class="mb-6 p-4 rounded-md border 
                        @if($organisasi->status === 'pending') bg-yellow-50 border-yellow-200 
                        @elseif($organisasi->status === 'aktif') bg-green-50 border-green-200 
                        @else bg-red-50 border-red-200 @endif">
                        <span class="block text-xs text-gray-500 uppercase font-semibold mb-1">Status Saat Ini</span>
                        <span class="text-lg font-bold uppercase 
                            @if($organisasi->status === 'pending') text-yellow-700 
                            @elseif($organisasi->status === 'aktif') text-green-700 
                            @else text-red-700 @endif">
                            {{ $organisasi->status }}
                        </span>
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 p-3 text-sm text-red-800 bg-red-100 rounded-lg">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.organisasi.update-status', $organisasi->id) }}" method="POST" x-data="{ status: '{{ $organisasi->status }}' }">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-5">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Ubah Status Registrasi</label>
                            <select id="status" name="status" x-model="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                <option value="pending">⏳ Tunda (Pending)</option>
                                <option value="aktif">✅ Terima (Aktif)</option>
                                <option value="ditolak">❌ Tolak (Ditolak)</option>
                            </select>
                        </div>

                        <!-- Kolom ini hanya muncul JIKA opsi ditolak dipilih (x-show) -->
                        <div class="mb-5" x-show="status === 'ditolak'" style="display: none;">
                            <label for="pesan_penolakan" class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                            <textarea id="pesan_penolakan" name="pesan_penolakan" rows="3" placeholder="Berikan alasan mengapa pengajuan ditolak (contoh: SK tidak valid, dsb)..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">{{ old('pesan_penolakan', $organisasi->pesan_penolakan) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Pesan ini akan ditampilkan ke dashboard organisasi terkait.</p>
                        </div>

                        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                            Simpan Keputusan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>