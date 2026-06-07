<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Montserrat:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Great+Vibes&display=swap" rel="stylesheet">

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Sertifikat: ') }} {{ $event->nama_event }}
            </h2>
            <a href="{{ route('organisasi.event.index') }}" class="text-sm px-4 py-2 bg-white border rounded-md shadow-sm">&larr; Kembali</a>
        </div>
    </x-slot>

    <div class="py-8" x-data="sertifikatApp()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg font-semibold">{{ session('success') }}</div>
            @endif

            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button @click="activeTab = 'setup'" :class="{'border-indigo-500 text-indigo-600 font-bold': activeTab === 'setup', 'border-transparent text-gray-500 hover:text-gray-700': activeTab !== 'setup'}" class="whitespace-nowrap py-4 px-1 border-b-2 text-sm transition-colors">
                        Setup Template
                    </button>
                    <button @click="activeTab = 'peserta'" :class="{'border-indigo-500 text-indigo-600 font-bold': activeTab === 'peserta', 'border-transparent text-gray-500 hover:text-gray-700': activeTab !== 'peserta'}" class="whitespace-nowrap py-4 px-1 border-b-2 text-sm transition-colors">
                        Upload Peserta
                    </button>
                </nav>
            </div>

            <div x-show="activeTab === 'setup'" class="flex flex-col lg:flex-row gap-6">
                
                <div class="w-full lg:w-1/3 space-y-6">
                    <form action="{{ route('organisasi.event.sertifikat.template', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Template</h3>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                        <span>Klik atau seret file JPG/PNG di sini</span>
                                        <input type="file" name="file_template" @change="previewImage" accept="image/jpeg, image/png, image/jpg" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">MAKSIMUM 5MB</p>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pengaturan Posisi Nama</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Posisi Horizontal (X)</label>
                                    <div class="flex items-center gap-4 mt-1">
                                        <input type="range" name="posisi_x" x-model="posisiX" min="0" max="100" class="w-full h-2 bg-indigo-200 rounded-lg appearance-none cursor-pointer">
                                        <input type="number" x-model="posisiX" class="w-20 text-center border-gray-300 rounded-md text-sm">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Posisi Vertikal (Y)</label>
                                    <div class="flex items-center gap-4 mt-1">
                                        <input type="range" name="posisi_y" x-model="posisiY" min="0" max="100" class="w-full h-2 bg-indigo-200 rounded-lg appearance-none cursor-pointer">
                                        <input type="number" x-model="posisiY" class="w-20 text-center border-gray-300 rounded-md text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jenis Font</label>
                                    <select name="jenis_font" x-model="jenisFont" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50">
                                        <option value="Poppins">Poppins</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Playfair Display">Playfair Display</option>
                                        <option value="Great Vibes">Great Vibes</option>
                                    </select>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Ukuran Font (px)</label>
                                        <select name="ukuran_font" x-model="ukuranFont" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50">
                                            <option value="24">24px</option>
                                            <option value="32">32px</option>
                                            <option value="48">48px</option>
                                            <option value="64">64px</option>
                                            <option value="80">80px</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Warna Teks</label>
                                        <div class="flex items-center gap-2 mt-1">
                                            <input type="color" x-model="warnaFont" class="h-10 w-12 p-1 rounded-md border-gray-300 cursor-pointer">
                                            <input type="text" name="warna_font" x-model="warnaFont" readonly class="w-full text-sm border-gray-300 rounded-md bg-gray-100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="mt-6 w-full bg-[#000033] text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-900 transition flex justify-center items-center gap-2 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Simpan Template
                            </button>
                        </div>
                    </form>
                </div>

                <div class="w-full lg:w-2/3 bg-white p-6 rounded-lg shadow-sm border flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-[#000033]">Preview Sertifikat</h3>
                        <span class="text-xs bg-gray-800 text-white px-3 py-1 rounded-full flex items-center gap-1 cursor-default">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                            SERET UNTUK PINDAHKAN POSISI TEKS
                        </span>
                    </div>

                    <div class="relative w-full bg-gray-200 rounded-lg overflow-hidden border border-gray-300" style="aspect-ratio: 1.414 / 1;" x-ref="canvas">
                        <img :src="imageUrl" class="absolute inset-0 w-full h-full object-contain pointer-events-none" alt="Template Background">
                        
                        <div 
                            class="absolute cursor-move px-4 py-2 border-2 border-transparent hover:border-gray-400 rounded whitespace-nowrap"
                            :style="`left: ${posisiX}%; top: ${posisiY}%; transform: translate(-50%, -50%); font-family: '${jenisFont}'; font-size: ${ukuranFont}px; color: ${warnaFont};`"
                            @mousedown="startDrag($event)"
                            @touchstart="startDrag($event)">
                            Nama Lengkap Peserta
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'peserta'" style="display: none;" class="bg-white p-6 rounded-lg shadow-sm border">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Data Peserta</h3>
                <p class="text-sm text-gray-600 mb-6">Unggah file CSV (Baris pertama akan diabaikan sebagai header). Kolom 1: <strong>Nama Peserta</strong>, Kolom 2: <strong>Email</strong>.</p>
                
                <form action="{{ route('organisasi.event.sertifikat.peserta', $event->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4 items-start sm:items-end mb-8 border-b pb-8">
                    @csrf
                    <div class="flex-1 w-full">
                        <input type="file" name="file_csv" accept=".csv" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md bg-white">
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-md hover:bg-indigo-700 transition w-full sm:w-auto">
                        Mulai Import CSV
                    </button>
                </form>

                <h4 class="font-bold text-gray-800 mb-4">Daftar Penerima Sertifikat ({{ $peserta->count() }})</h4>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-left text-sm text-gray-500">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-6 py-3 border-b font-semibold">No</th>
                                <th class="px-6 py-3 border-b font-semibold">Nama Peserta</th>
                                <th class="px-6 py-3 border-b font-semibold">Email</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($peserta as $index => $p)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $p->nama_peserta }}</td>
                                    <td class="px-6 py-4">{{ $p->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">Belum ada peserta yang diimpor.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function sertifikatApp() {
            return {
                activeTab: 'setup',
                posisiX: {{ $template->posisi_x }},
                posisiY: {{ $template->posisi_y }},
                jenisFont: '{{ $template->jenis_font }}',
                ukuranFont: {{ $template->ukuran_font }},
                warnaFont: '{{ $template->warna_font }}',
                imageUrl: '{{ $template->file_template ? asset("storage/".$template->file_template) : "https://via.placeholder.com/800x600.png?text=Preview+Sertifikat" }}',
                
                isDragging: false,
                
                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.imageUrl = URL.createObjectURL(file);
                    }
                },

                startDrag(e) {
                    this.isDragging = true;
                    e.preventDefault();
                    
                    const moveHandler = (moveEvent) => {
                        if (!this.isDragging) return;
                        
                        const canvas = this.$refs.canvas;
                        const rect = canvas.getBoundingClientRect();
                        
                        const clientX = moveEvent.touches ? moveEvent.touches[0].clientX : moveEvent.clientX;
                        const clientY = moveEvent.touches ? moveEvent.touches[0].clientY : moveEvent.clientY;
                        
                        let x = ((clientX - rect.left) / rect.width) * 100;
                        let y = ((clientY - rect.top) / rect.height) * 100;
                        
                        this.posisiX = Math.max(0, Math.min(100, Math.round(x)));
                        this.posisiY = Math.max(0, Math.min(100, Math.round(y)));
                    };
                    
                    const stopHandler = () => {
                        this.isDragging = false;
                        document.removeEventListener('mousemove', moveHandler);
                        document.removeEventListener('mouseup', stopHandler);
                        document.removeEventListener('touchmove', moveHandler);
                        document.removeEventListener('touchend', stopHandler);
                    };

                    document.addEventListener('mousemove', moveHandler);
                    document.addEventListener('mouseup', stopHandler);
                    document.addEventListener('touchmove', moveHandler, { passive: false });
                    document.addEventListener('touchend', stopHandler);
                }
            }
        }
    </script>
</x-app-layout>