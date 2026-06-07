<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" x-data="{ role: 'mahasiswa' }">
        @csrf

        <div class="mb-6 text-center">
            <span class="text-gray-700 font-semibold mb-2 block">Mendaftar Sebagai:</span>
            <div class="flex justify-center space-x-4">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" x-model="role" name="role" value="mahasiswa" class="text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-gray-700">Mahasiswa</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" x-model="role" name="role" value="organisasi" class="text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-gray-700">Organisasi</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div x-show="role === 'mahasiswa'" class="mt-6 p-4 border rounded-md bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Profil Mahasiswa</h3>
            
            <div>
                <x-input-label for="nama_mahasiswa" :value="__('Nama Lengkap')" />
                <x-text-input id="nama_mahasiswa" class="block mt-1 w-full" type="text" name="nama_mahasiswa" :value="old('nama_mahasiswa')" />
                <x-input-error :messages="$errors->get('nama_mahasiswa')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="nim" :value="__('NIM')" />
                <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" />
                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="prodi_mahasiswa" :value="__('Program Studi (Opsional)')" />
                <x-text-input id="prodi_mahasiswa" class="block mt-1 w-full" type="text" name="prodi_mahasiswa" :value="old('prodi_mahasiswa')" />
            </div>
        </div>

        <div x-show="role === 'organisasi'" class="mt-6 p-4 border rounded-md bg-gray-50" style="display: none;">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Profil Organisasi</h3>
            
            <div>
                <x-input-label for="nama_organisasi" :value="__('Nama Organisasi')" />
                <x-text-input id="nama_organisasi" class="block mt-1 w-full" type="text" name="nama_organisasi" :value="old('nama_organisasi')" />
                <x-input-error :messages="$errors->get('nama_organisasi')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="no_organisasi" :value="__('Nomor Registrasi/SK Organisasi')" />
                <x-text-input id="no_organisasi" class="block mt-1 w-full" type="text" name="no_organisasi" :value="old('no_organisasi')" />
                <x-input-error :messages="$errors->get('no_organisasi')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="tingkat_organisasi" :value="__('Tingkat Organisasi')" />
                <select id="tingkat_organisasi" name="tingkat_organisasi" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                    <option value="prodi">Program Studi (Himpunan)</option>
                    <option value="fakultas">Fakultas (BEM/BPM)</option>
                    <option value="universitas">Universitas (UKM)</option>
                </select>
            </div>

            <div class="mt-4">
                <x-input-label for="fakultas_id" :value="__('Fakultas (Opsional)')" />
                <select id="fakultas_id" name="fakultas_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                    <option value="">-- Pilih Fakultas --</option>
                    @foreach($fakultas as $fak)
                        <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mt-4">
                <x-input-label for="prodi_organisasi" :value="__('Program Studi (Jika tingkat Prodi)')" />
                <x-text-input id="prodi_organisasi" class="block mt-1 w-full" type="text" name="prodi_organisasi" :value="old('prodi_organisasi')" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>