{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}



<?php
// Eventoria - Campus Event Management Platform
// Data dummy (bisa diganti dengan data dari database)

$stats = [
    ['value' => '1.200+', 'label' => 'Total Event'],
    ['value' => '85+',    'label' => 'Total Organisasi'],
    ['value' => '10k+',   'label' => 'Total Mahasiswa'],
];

$categories = [
    ['icon' => 'graduation-cap', 'label' => 'Seminar'],
    ['icon' => 'desktop',        'label' => 'Workshop'],
    ['icon' => 'trophy',         'label' => 'Kompetisi'],
    ['icon' => 'palette',        'label' => 'Seni'],
];

$events = [
    [
        'title'  => 'Inovasi Teknologi 2026',
        'date'   => '24 Oktober 2026',
        'org'    => 'Himpunan Mahasiswa Informatika',
        'image'  => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80',
        'status' => 'Sudah ACC',
    ],
    [
        'title'  => 'Workshop UI/UX Design',
        'date'   => '28 Oktober 2026',
        'org'    => 'Creative Design Club',
        'image'  => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&q=80',
        'status' => 'Sudah ACC',
    ],
    [
        'title'  => 'Festival Seni Budaya',
        'date'   => '05 November 2026',
        'org'    => 'UKM Kesenian Mahasiswa',
        'image'  => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=600&q=80',
        'status' => 'Sudah ACC',
    ],
];

$footer_links = [
    'LAYANAN'     => ['Cari Event', 'Pendaftaran Organisasi', 'Sistem Penilaian'],
    'ORGANISASI'  => ['Tentang Kami', 'Kontak', 'Panduan'],
    'BANTUAN'     => ['FAQ', 'Pusat Bantuan', 'Kebijakan Privasi'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventoria – Temukan Event Campus Terbaik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ── Reset & Base ───────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:        #0D1B5E;
            --navy-light:  #1a2d8a;
            --blue-mid:    #2563EB;
            --accent:      #3B4FD4;
            --bg:          #F4F6FB;
            --white:       #FFFFFF;
            --text-dark:   #0D1B5E;
            --text-body:   #4A5568;
            --text-muted:  #718096;
            --border:      #E2E8F0;
            --badge-green: #10B981;
            --radius-card: 14px;
            --radius-btn:  8px;
            --shadow-sm:   0 1px 4px rgba(13,27,94,.08);
            --shadow-md:   0 4px 16px rgba(13,27,94,.12);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--white);
            color: var(--text-body);
            line-height: 1.6;
            font-size: 15px;
        }

        img { display: block; max-width: 100%; }

        a { text-decoration: none; color: inherit; }

        /* ── Utility ────────────────────────────────────────── */
        .container {
            width: 100%;
            max-width: 1100px;
            margin-inline: auto;
            padding-inline: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 28px;
            border-radius: var(--radius-btn);
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: background .2s, color .2s, transform .15s, box-shadow .2s;
            white-space: nowrap;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary {
            background: var(--navy);
            color: var(--white);
            border-color: var(--navy);
        }
        .btn-primary:hover { background: var(--navy-light); border-color: var(--navy-light); }
        .btn-outline {
            background: transparent;
            color: var(--navy);
            border-color: var(--navy);
        }
        .btn-outline:hover { background: var(--navy); color: var(--white); }
        .btn-outline-white {
            background: transparent;
            color: var(--white);
            border-color: var(--white);
        }
        .btn-outline-white:hover { background: var(--white); color: var(--navy); }
        .btn-white {
            background: var(--white);
            color: var(--navy);
            border-color: var(--white);
        }
        .btn-white:hover { background: #eef0f8; }

        /* ── Navbar ─────────────────────────────────────────── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding-block: 14px;
        }
        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .nav-brand {
            font-size: 20px;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -.5px;
        }
        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }
        .nav-links a {
            font-weight: 500;
            color: var(--text-muted);
            font-size: 14px;
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
            transition: color .2s, border-color .2s;
        }
        .nav-links a.active,
        .nav-links a:hover {
            color: var(--navy);
            border-bottom-color: var(--navy);
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .nav-icon {
            color: var(--text-muted);
            font-size: 17px;
            cursor: pointer;
            transition: color .2s;
        }
        .nav-icon:hover { color: var(--navy); }
        .nav-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }
        .hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--navy);
            border-radius: 2px;
            transition: transform .3s, opacity .3s;
        }
        .mobile-menu {
            display: none;
            flex-direction: column;
            background: var(--white);
            border-top: 1px solid var(--border);
            padding: 16px 24px;
            gap: 12px;
        }
        .mobile-menu a {
            font-weight: 500;
            color: var(--text-body);
            padding-block: 8px;
            border-bottom: 1px solid var(--border);
        }
        .mobile-menu.open { display: flex; }

        /* ── Hero ───────────────────────────────────────────── */
        .hero {
            background: var(--bg);
            padding-block: 80px 64px;
            text-align: center;
        }
        .hero-eyebrow {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 20px;
        }
        .hero h1 {
            font-size: clamp(32px, 5.5vw, 56px);
            font-weight: 900;
            color: var(--navy);
            line-height: 1.15;
            max-width: 700px;
            margin-inline: auto;
            margin-bottom: 20px;
            letter-spacing: -.5px;
        }
        .hero p {
            max-width: 520px;
            margin-inline: auto;
            color: var(--text-muted);
            font-size: 16px;
            margin-bottom: 36px;
        }
        .hero-cta {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }
        .search-bar {
            display: flex;
            align-items: center;
            max-width: 560px;
            margin-inline: auto;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 6px 6px 6px 16px;
            box-shadow: var(--shadow-sm);
            gap: 10px;
        }
        .search-bar i { color: var(--text-muted); flex-shrink: 0; }
        .search-bar input {
            flex: 1;
            border: none;
            outline: none;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: var(--text-dark);
            background: transparent;
            min-width: 0;
        }
        .search-bar input::placeholder { color: var(--text-muted); }
        .btn-search {
            background: var(--navy);
            color: var(--white);
            border: none;
            border-radius: 7px;
            padding: 11px 22px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s;
        }
        .btn-search:hover { background: var(--navy-light); }

        /* ── Stats ──────────────────────────────────────────── */
        .stats {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding-block: 48px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            text-align: center;
        }
        .stat-value {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 900;
            color: var(--navy);
            letter-spacing: -.5px;
        }
        .stat-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            font-weight: 600;
            margin-top: 4px;
        }

        /* ── Section header ─────────────────────────────────── */
        .section { padding-block: 64px; }
        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .section-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--navy);
        }
        .section-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }
        .link-all {
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 5px;
            transition: gap .2s;
        }
        .link-all:hover { gap: 9px; }

        /* ── Categories ─────────────────────────────────────── */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        .category-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-card);
            padding: 24px 20px;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s, transform .2s;
        }
        .category-card:hover {
            border-color: var(--navy);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }
        .category-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: #EEF2FF;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            color: var(--navy);
            font-size: 18px;
        }
        .category-label {
            font-weight: 700;
            color: var(--navy);
            font-size: 15px;
        }

        /* ── Event Cards ────────────────────────────────────── */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .event-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-card);
            overflow: hidden;
            transition: box-shadow .2s, transform .2s;
        }
        .event-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }
        .event-thumb {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .event-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }
        .event-card:hover .event-thumb img { transform: scale(1.04); }
        .badge-acc {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--white);
            color: var(--badge-green);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 6px rgba(0,0,0,.12);
        }
        .badge-acc i { font-size: 10px; }
        .event-body { padding: 18px; }
        .event-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 10px;
            line-height: 1.35;
        }
        .event-meta {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12.5px;
            color: var(--text-muted);
            margin-bottom: 6px;
        }
        .event-meta i { color: var(--accent); width: 14px; }
        .btn-detail {
            display: block;
            width: 100%;
            text-align: center;
            background: #EEF2FF;
            color: var(--navy);
            border: none;
            border-radius: 7px;
            padding: 10px;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
            margin-top: 14px;
            transition: background .2s, color .2s;
        }
        .btn-detail:hover { background: var(--navy); color: var(--white); }

        /* ── CTA Banner ─────────────────────────────────────── */
        .cta-banner {
            background: var(--navy);
            border-radius: 20px;
            padding: 64px 40px;
            text-align: center;
            margin-block: 0 64px;
        }
        .cta-banner h2 {
            font-size: clamp(24px, 3.5vw, 36px);
            font-weight: 900;
            color: var(--white);
            margin-bottom: 14px;
            letter-spacing: -.3px;
        }
        .cta-banner p {
            color: rgba(255,255,255,.7);
            max-width: 420px;
            margin-inline: auto;
            margin-bottom: 32px;
            font-size: 15px;
        }
        .cta-buttons {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* ── Footer ─────────────────────────────────────────── */
        footer {
            border-top: 1px solid var(--border);
            padding-block: 56px 32px;
            background: var(--white);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.8fr repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 48px;
        }
        .footer-brand-name {
            font-size: 20px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 12px;
        }
        .footer-brand-desc {
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.65;
            max-width: 220px;
        }
        .footer-col-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-dark);
            margin-bottom: 16px;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col a {
            font-size: 13.5px;
            color: var(--text-muted);
            transition: color .2s;
        }
        .footer-col a:hover { color: var(--navy); }
        .footer-bottom {
            border-top: 1px solid var(--border);
            padding-top: 24px;
            text-align: center;
            font-size: 12.5px;
            color: var(--text-muted);
        }

        /* ── Responsive ─────────────────────────────────────── */
        @media (max-width: 960px) {
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .events-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-brand-desc { max-width: 100%; }
        }

        @media (max-width: 700px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .hero { padding-block: 56px 48px; }
            .stats-grid { grid-template-columns: 1fr; gap: 32px; }
            .stats-grid .stat-item + .stat-item { border-top: 1px solid var(--border); padding-top: 28px; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .events-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .cta-banner { padding: 48px 24px; border-radius: 14px; }
            .section { padding-block: 48px; }
        }

        @media (max-width: 400px) {
            .categories-grid { grid-template-columns: 1fr 1fr; }
            .hero h1 { font-size: 28px; }
            .btn { padding: 11px 20px; font-size: 14px; }
        }
    </style>
</head>
<body>

<!-- ── Navbar ──────────────────────────────────────────── -->
<header class="navbar">
    <div class="container">
        <nav class="navbar-inner">
            <a href="#" class="nav-brand">Eventoria</a>

            <ul class="nav-links">
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="#">Events</a></li>
            </ul>

            <div class="nav-actions">
                <i class="fa-regular fa-bell nav-icon"></i>
                <i class="fa-solid fa-gear nav-icon"></i>
                <img class="nav-avatar"
                     src="https://i.pravatar.cc/40?img=12"
                     alt="User Avatar">
                <div class="hamburger" id="hamburger" aria-label="Menu" role="button" tabindex="0">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </nav>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <a href="#">Dashboard</a>
        <a href="#">Events</a>
        <a href="#">Profil</a>
    </div>
</header>

<!-- ── Hero ────────────────────────────────────────────── -->
<section class="hero">
    <div class="container">
        <span class="hero-eyebrow">Platform Event Kampus #1</span>
        <h1>Temukan Event Campus Terbaik dengan Mudah</h1>
        <p>Platform manajemen event modern untuk mahasiswa dan organisasi kampus. Kelola, cari, dan ikuti berbagai kegiatan akademik serta kreatif dalam satu tempat.</p>

        <div class="hero-cta">
            <a href="#events" class="btn btn-primary">
                <i class="fa-solid fa-compass"></i> Jelajahi Event
            </a>
            <a href="#" class="btn btn-outline">
                <i class="fa-solid fa-building-columns"></i> Daftar Organisasi
            </a>
        </div>

        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari nama event, organisasi, atau topik...">
            <button class="btn-search">Cari Sekarang</button>
        </div>
    </div>
</section>

<!-- ── Stats ───────────────────────────────────────────── -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <?php foreach ($stats as $s): ?>
            <div class="stat-item">
                <div class="stat-value"><?= htmlspecialchars($s['value']) ?></div>
                <div class="stat-label"><?= htmlspecialchars($s['label']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Kategori ─────────────────────────────────────────── -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div>
                <h2 class="section-title">Kategori Event Populer</h2>
            </div>
        </div>
        <div class="categories-grid">
            <?php
            $icons = [
                'graduation-cap' => 'fa-graduation-cap',
                'desktop'        => 'fa-desktop',
                'trophy'         => 'fa-trophy',
                'palette'        => 'fa-palette',
            ];
            foreach ($categories as $cat):
            ?>
            <div class="category-card">
                <div class="category-icon">
                    <i class="fa-solid <?= $icons[$cat['icon']] ?>"></i>
                </div>
                <div class="category-label"><?= htmlspecialchars($cat['label']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Events Terbaru ───────────────────────────────────── -->
<section class="section" id="events" style="padding-top: 0;">
    <div class="container">
        <div class="section-header">
            <div>
                <h2 class="section-title">Event Terbaru</h2>
                <p class="section-subtitle">Kegiatan kampus yang telah diverifikasi dan siap diikuti.</p>
            </div>
            <a href="#" class="link-all">Lihat Semua Event <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="events-grid">
            <?php foreach ($events as $event): ?>
            <article class="event-card">
                <div class="event-thumb">
                    <img src="<?= htmlspecialchars($event['image']) ?>"
                         alt="<?= htmlspecialchars($event['title']) ?>"
                         loading="lazy">
                    <span class="badge-acc">
                        <i class="fa-solid fa-circle-check"></i>
                        <?= htmlspecialchars($event['status']) ?>
                    </span>
                </div>
                <div class="event-body">
                    <h3 class="event-title"><?= htmlspecialchars($event['title']) ?></h3>
                    <div class="event-meta">
                        <i class="fa-regular fa-calendar"></i>
                        <?= htmlspecialchars($event['date']) ?>
                    </div>
                    <div class="event-meta">
                        <i class="fa-solid fa-users"></i>
                        <?= htmlspecialchars($event['org']) ?>
                    </div>
                    <button class="btn-detail">Lihat Detail</button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── CTA Banner ───────────────────────────────────────── -->
<div class="container">
    <div class="cta-banner">
        <h2>Siap Memulai Event Pertamamu?</h2>
        <p>Bergabunglah dengan ribuan mahasiswa lainnya dan jadikan kegiatan kampusmu lebih terorganisir dan berkesan.</p>
        <div class="cta-buttons">
            <a href="#" class="btn btn-white">Daftar Sekarang</a>
            <a href="#" class="btn btn-outline-white">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</div>

<!-- ── Footer ───────────────────────────────────────────── -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-brand-name">Eventoria</div>
                <p class="footer-brand-desc">
                    Solusi manajemen event kampus paling terpercaya untuk efisiensi akademik.
                </p>
            </div>

            <?php foreach ($footer_links as $title => $links): ?>
            <div class="footer-col">
                <div class="footer-col-title"><?= htmlspecialchars($title) ?></div>
                <ul>
                    <?php foreach ($links as $link): ?>
                    <li><a href="#"><?= htmlspecialchars($link) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="footer-bottom">
            &copy; <?= date('Y') ?> Eventoria Academic Management. All rights reserved.
        </div>
    </div>
</footer>

<!-- ── Scripts ──────────────────────────────────────────── -->
<script>
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
    });

    // Keyboard accessibility for hamburger
    hamburger.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            mobileMenu.classList.toggle('open');
        }
    });

    // Close mobile menu when a link is clicked
    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => mobileMenu.classList.remove('open'));
    });

    // Smooth active link highlighting on scroll (optional enhancement)
    const sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(sec => {
            if (window.scrollY >= sec.offsetTop - 80) current = sec.id;
        });
    }, { passive: true });
</script>

</body>
</html>