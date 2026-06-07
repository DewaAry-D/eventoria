<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Fakultas;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $fakultas = Fakultas::all();
        return view('auth.register', compact('fakultas'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => ['required', 'in:mahasiswa,organisasi'],
        ]);

        // 2. Validasi Spesifik Berdasarkan Role
        if ($request->role === 'mahasiswa') {
            $request->validate([
                'nama_mahasiswa' => ['required', 'string', 'max:255'],
                'nim' => ['required', 'string', 'max:50', 'unique:mahasiswa,nim'],
                'prodi_mahasiswa' => ['nullable', 'string', 'max:200'],
            ]);
        } else {
            $request->validate([
                'nama_organisasi' => ['required', 'string', 'max:255'],
                'no_organisasi' => ['required', 'string', 'max:50', 'unique:organisasi_mahasiswa,no_organisasi'],
                'tingkat_organisasi' => ['required', 'in:prodi,fakultas,universitas'],
                'fakultas_id' => ['nullable', 'exists:fakultas,id'],
                'prodi_organisasi' => ['nullable', 'string', 'max:200'],
            ]);
        }

        // 3. Simpan dengan Database Transaction
        DB::transaction(function () use ($request) {
            // Buat Akun User
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Buat Profil Sesuai Role
            if ($request->role === 'mahasiswa') {
                $user->mahasiswa()->create([
                    'nama' => $request->nama_mahasiswa,
                    'nim' => $request->nim,
                    'prodi' => $request->prodi_mahasiswa,
                ]);
            } else {
                $user->organisasi()->create([
                    'nama_organisasi' => $request->nama_organisasi,
                    'no_organisasi' => $request->no_organisasi,
                    'tingkat_organisasi' => $request->tingkat_organisasi,
                    'fakultas_id' => $request->fakultas_id,
                    'prodi' => $request->prodi_organisasi,
                    'status' => 'pending', // Default status saat baru daftar
                ]);
            }

            event(new \Illuminate\Auth\Events\Registered($user));
            Auth::login($user);
        });

        // 4. Redirect Sesuai Role
        $role = Auth::user()->role;
        $url = match ($role) {
            'organisasi' => route('organisasi.dashboard', absolute: false),
            'mahasiswa'  => route('mahasiswa.dashboard', absolute: false),
            default      => '/',
        };

        return redirect()->intended($url);
    }
}
