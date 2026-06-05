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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full whitespace-nowrap text-left text-sm text-gray-500">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-6 py-3">Nama Organisasi</th>
                                <th class="px-6 py-3">Tingkat</th>
                                <th class="px-6 py-3">Fakultas</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($organisasi as $org)
                            <tr>
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
                                    <a href="{{ route('admin.organisasi.show', $org->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Detail & Aksi</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $organisasi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>