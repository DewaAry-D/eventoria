{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<?php
// login.php - Halaman Login Eventoria

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Contoh validasi sederhana — ganti dengan logika autentikasi Anda
    if (empty($email) || empty($password)) {
        $error = 'Email dan kata sandi tidak boleh kosong.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format alamat email tidak valid.';
    } else {
        // TODO: Cek kredensial ke database
        // Contoh sementara:
        // $success = 'Login berhasil! Mengalihkan...';
        $error = 'Email atau kata sandi salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login – Eventoria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50:  '#eef1f8',
                            100: '#d5ddf0',
                            200: '#aabae1',
                            300: '#7b93cf',
                            400: '#4f6dbc',
                            500: '#2e4fa3',
                            600: '#1e3580',
                            700: '#162867',
                            800: '#0f1d4e',
                            900: '#0a1235',
                            950: '#060b22',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        /* Overlay gradient pada sisi kiri */
        .hero-overlay {
            background: linear-gradient(
                160deg,
                rgba(10, 22, 80, 0.82) 0%,
                rgba(14, 30, 100, 0.75) 50%,
                rgba(8, 15, 60, 0.88) 100%
            );
        }
        /* Focus ring khusus */
        .input-field:focus {
            outline: none;
            border-color: #1e3580;
            box-shadow: 0 0 0 3px rgba(30, 53, 128, 0.15);
        }
        /* Tombol login hover */
        .btn-login {
            transition: background-color 0.2s ease, transform 0.1s ease, box-shadow 0.2s ease;
        }
        .btn-login:hover {
            background-color: #162867;
            box-shadow: 0 4px 18px rgba(14, 29, 95, 0.35);
        }
        .btn-login:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body class="min-h-screen bg-white flex items-center justify-center font-sans">

    <!-- Wrapper kartu utama -->
    <div class="w-full h-screen bg-white overflow-hidden flex flex-col lg:flex-row">

        <!-- ===================== SISI KIRI – HERO ===================== -->
        <div class="relative lg:w-[52%] w-full min-h-[280px] lg:min-h-0 flex flex-col justify-between overflow-hidden">

            <!-- Gambar latar belakang (ganti src dengan gambar asli Anda) -->
            <img
                src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=900&q=80"
                alt="Auditorium kampus"
                class="absolute inset-0 w-full h-full object-cover object-center"
            />
            <!-- Overlay gelap berwarna navy -->
            <div class="hero-overlay absolute inset-0"></div>

            <!-- Konten di atas overlay -->
            <div class="relative z-10 flex flex-col h-full p-8 lg:p-12 justify-center">

                <!-- Logo / nama aplikasi -->
                <div class="mb-8">
                    <span class="text-white/80 text-xs font-semibold tracking-[0.2em] uppercase">
                        EVENTORIA
                    </span>
                </div>

                <!-- Tagline utama -->
                <div class="mb-8">
                    <h1 class="text-white font-extrabold text-3xl sm:text-4xl lg:text-[2.6rem] leading-tight mb-4">
                        Kelola Event<br />Kampus Lebih<br />Efisien.
                    </h1>
                    <p class="text-white/70 text-sm leading-relaxed max-w-xs">
                        Satu platform terintegrasi untuk mahasiswa, organisasi,
                        dan administrasi kampus dalam mengatur jadwal dan
                        kegiatan akademik.
                    </p>
                </div>

                <!-- Fitur unggulan -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Fitur 1 -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-4 flex flex-col gap-2">
                        <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span class="text-white text-xs font-medium leading-snug">Penjadwalan<br/>Otomatis</span>
                    </div>
                    <!-- Fitur 2 -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-4 flex flex-col gap-2">
                        <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <line x1="18" y1="20" x2="18" y2="10"/>
                            <line x1="12" y1="20" x2="12" y2="4"/>
                            <line x1="6"  y1="20" x2="6"  y2="14"/>
                        </svg>
                        <span class="text-white text-xs font-medium leading-snug">Laporan<br/>Real-time</span>
                    </div>
                </div>

            </div><!-- /konten hero -->
        </div>
        <!-- ===================== /SISI KIRI ===================== -->

        <!-- ===================== SISI KANAN – FORM LOGIN ===================== -->
        <div class="lg:w-[48%] w-full flex items-center justify-center px-8 py-10 sm:px-12 lg:px-14">
            <div class="w-full max-w-sm">

                <!-- Judul -->
                <h2 class="text-navy-800 font-extrabold text-2xl sm:text-3xl leading-tight mb-1">
                    Selamat Datang Kembali
                </h2>
                <p class="text-gray-500 text-sm mb-8">
                    Masuk ke akun akademik Anda untuk melanjutkan.
                </p>

                <?php if ($error): ?>
                <div class="mb-5 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <?php if ($success): ?>
                <div class="mb-5 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
                    <?= htmlspecialchars($success) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="" novalidate>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-1.5">
                            Alamat Email Kampus
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="nama@mahasiswa.ac.id"
                            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                            autocomplete="email"
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg text-sm text-gray-800 placeholder-gray-400 transition"
                        />
                    </div>

                    <!-- Kata Sandi -->
                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="text-gray-700 text-sm font-medium">
                                Kata Sandi
                            </label>
                            <a href="lupa-kata-sandi.php" class="text-navy-600 text-sm font-medium hover:underline">
                                Lupa kata sandi?
                            </a>
                        </div>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                class="input-field w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg text-sm text-gray-800 placeholder-gray-400 transition"
                            />
                            <!-- Tombol toggle password -->
                            <button
                                type="button"
                                onclick="togglePassword()"
                                aria-label="Tampilkan/sembunyikan kata sandi"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                            >
                                <svg id="icon-eye-off" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg id="icon-eye-on" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
                                    <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
                                    <line x1="1" y1="1" x2="23" y2="23"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Ingat saya -->
                    <div class="flex items-center gap-2.5 mb-6">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-navy-700 cursor-pointer accent-navy-700"
                        />
                        <label for="remember" class="text-sm text-gray-600 cursor-pointer select-none">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <!-- Tombol masuk -->
                    <button
                        type="submit"
                        class="btn-login w-full bg-navy-800 hover:bg-navy-900 text-white font-semibold text-sm py-3.5 px-6 rounded-lg flex items-center justify-center gap-2.5"
                    >
                        Masuk Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>

                </form>

                <!-- Divider -->
                <div class="my-6 border-t border-gray-200"></div>

                <!-- Daftar -->
                <p class="text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="daftar.php" class="text-navy-700 font-bold hover:underline ml-1">
                        Daftar di sini
                    </a>
                </p>

                <!-- Footer link -->
                <div class="mt-5 flex items-center justify-center gap-5">
                    <a href="bantuan.php" class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                        Pusat Bantuan
                    </a>
                    <a href="?lang=id" class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
                        </svg>
                        Bahasa Indonesia
                    </a>
                </div>

            </div>
        </div>
        <!-- ===================== /SISI KANAN ===================== -->

    </div><!-- /wrapper -->

    <script>
        function togglePassword() {
            const input   = document.getElementById('password');
            const iconOff = document.getElementById('icon-eye-off');
            const iconOn  = document.getElementById('icon-eye-on');
            const isHidden = input.type === 'password';

            input.type    = isHidden ? 'text' : 'password';
            iconOff.classList.toggle('hidden', isHidden);
            iconOn.classList.toggle('hidden', !isHidden);
        }
    </script>

</body>
</html>