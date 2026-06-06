<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validasi Organisasi Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg mb-6 p-6">
                <form action="{{ route('admin.organisasi.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama / SK</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari organisasi..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat</label>
                            <select name="tingkat" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Semua Tingkat</option>
                                <option value="prodi" {{ request('tingkat') == 'prodi' ? 'selected' : '' }}>Program Studi</option>
                                <option value="fakultas" {{ request('tingkat') == 'fakultas' ? 'selected' : '' }}>Fakultas</option>
                                <option value="universitas" {{ request('tingkat') == 'universitas' ? 'selected' : '' }}>Universitas</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                            <select name="fakultas" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Semua Fakultas</option>
                                @foreach($fakultasList as $fak)
                                    <option value="{{ $fak->id }}" {{ request('fakultas') == $fak->id ? 'selected' : '' }}>{{ $fak->nama_fakultas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Validasi</label>
                            <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        @if(request()->anyFilled(['search', 'tingkat', 'fakultas', 'status']))
                            <a href="{{ route('admin.organisasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Reset
                            </a>
                        @endif
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    
                    @if($organisasi->count() > 0)
                        <table class="w-full whitespace-nowrap text-left text-sm text-gray-500 border-collapse">
                            <thead class="bg-gray-50 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 border-b">Nama Organisasi</th>
                                    <th class="px-6 py-3 border-b">Tingkat</th>
                                    <th class="px-6 py-3 border-b">Fakultas</th>
                                    <th class="px-6 py-3 border-b">Status</th>
                                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($organisasi as $org)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $org->nama_organisasi }}</td>
                                    <td class="px-6 py-4 uppercase text-xs">{{ $org->tingkat_organisasi }}</td>
                                    <td class="px-6 py-4">{{ $org->fakultas?->nama_fakultas ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if($org->status === 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">PENDING</span>
                                        @elseif($org->status === 'aktif')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">AKTIF</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">DITOLAK</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.organisasi.show', $org->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3 font-semibold">Detail & Aksi</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
                            {{ $organisasi->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Data Tidak Ditemukan</h3>
                            <p class="mt-1 text-sm text-gray-500">Tidak ada organisasi yang sesuai dengan filter pencarian Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>