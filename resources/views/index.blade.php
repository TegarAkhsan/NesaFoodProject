@extends('layouts.app')
@section('title', 'Nesafood - Home')
@section('content')

@php
    // Helper to map real public images to dynamic database menu names
    if (!function_exists('getMenuImage')) {
        function getMenuImage($name) {
            $name = strtolower($name);
            if (str_contains($name, 'geprek')) return 'img/Ayam Geprek.jpg';
            if (str_contains($name, 'teriyaki')) return 'img/Ayam Teriyaki.jpg';
            if (str_contains($name, 'gado')) return 'img/Gado-Gado.jpg';
            if (str_contains($name, 'mie') || str_contains($name, 'bakso')) return 'img/Mie Ayam.jpg';
            if (str_contains($name, 'campur')) return 'img/Nasi Campur.jpg';
            if (str_contains($name, 'goreng') || str_contains($name, 'sate') || str_contains($name, 'rendang')) return 'img/Nasi Goreng.jpg';
            if (str_contains($name, 'bakar')) return 'img/Ayam Bakar.jpg';
            if (str_contains($name, 'kecap')) return 'img/Ayam Kecap.jpg';
            if (str_contains($name, 'pok')) return 'img/Ayam Pok-Pok.jpg';
            if (str_contains($name, 'lele')) return 'img/Nasi Lele.jpg';
            if (str_contains($name, 'uduk')) return 'img/Nasi Uduk.jpg';
            if (str_contains($name, 'soto')) return 'img/Nasi Uduk.jpg';
            return 'img/single-item.jpg'; // fallback
        }
    }

    // Fetch dynamic menus for Best Categories tabs
    $allMenus = \App\Models\Menu::with('stand')->latest()->get();
    $foods = $allMenus->where('type', 'makanan')->take(8);
    $drinks = $allMenus->where('type', 'minuman')->take(8);
@endphp

<style>
    :root {
        --nesa-primary: #81c408;
        --nesa-primary-hover: #6ea406;
        --nesa-primary-light: rgba(129, 196, 8, 0.08);
        --nesa-dark: #1b4332;
        --nesa-accent: #ff8c00;
        --nesa-card-shadow: 0 10px 30px rgba(27, 67, 50, 0.04);
        --nesa-card-hover: 0 16px 40px rgba(27, 67, 50, 0.08);
    }

    .hero-section {
        background: linear-gradient(135deg, #f2f9f2 0%, #ffffff 100%);
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
    }

    .card-product {
        border: none !important;
        border-radius: 18px !important;
        box-shadow: var(--nesa-card-shadow);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        overflow: hidden;
    }

    .card-product:hover {
        transform: translateY(-8px);
        box-shadow: var(--nesa-card-hover);
    }

    .card-product .img-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
        border-radius: 18px 18px 0 0;
    }

    .card-product .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card-product:hover .img-wrapper img {
        transform: scale(1.08);
    }

    .category-chip {
        padding: 8px 24px;
        font-weight: 700;
        border-radius: 99px !important;
        font-size: 0.9rem;
        transition: all 0.25s ease;
    }

    .category-chip.active {
        background-color: var(--nesa-primary) !important;
        color: #ffffff !important;
        box-shadow: 0 6px 15px rgba(129, 196, 8, 0.3);
    }

    .why-card {
        border: none;
        background-color: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: var(--nesa-card-shadow);
        transition: all 0.3s ease;
        height: 100%;
    }

    .why-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--nesa-card-hover);
    }

    .why-icon {
        width: 55px;
        height: 55px;
        background-color: var(--nesa-primary-light);
        color: var(--nesa-primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 20px;
    }

    .stats-banner {
        background: linear-gradient(135deg, var(--nesa-dark) 0%, #153527 100%);
        border-radius: 24px;
        padding: 40px;
        color: #ffffff;
        box-shadow: 0 15px 35px rgba(27,67,50,0.15);
    }

    .btn-nesa {
        border-radius: 12px;
        padding: 10px 24px;
        font-weight: 700;
        font-size: 0.92rem;
        transition: all 0.25s ease;
    }

    .btn-nesa-primary {
        background-color: var(--nesa-primary);
        color: #ffffff;
        border: none;
    }

    .btn-nesa-primary:hover {
        background-color: var(--nesa-primary-hover);
        color: #ffffff;
        box-shadow: 0 6px 18px rgba(129, 196, 8, 0.25);
    }

    .btn-nesa-outline {
        background: transparent;
        color: var(--nesa-primary-hover);
        border: 2px solid var(--nesa-primary);
    }

    .btn-nesa-outline:hover {
        background-color: var(--nesa-primary);
        color: #ffffff;
        box-shadow: 0 6px 18px rgba(129, 196, 8, 0.15);
    }

    .promo-card {
        border-radius: 18px;
        overflow: hidden;
        border: none;
        box-shadow: var(--nesa-card-shadow);
        transition: all 0.3s ease;
        height: 100%;
        background-color: #ffffff;
    }

    .promo-card:hover {
        transform: scale(1.02);
        box-shadow: var(--nesa-card-hover);
    }

    .bestseller-item {
        transition: all 0.3s ease;
        border-radius: 16px;
    }

    .bestseller-item:hover {
        background-color: var(--nesa-primary-light) !important;
        transform: translateX(5px);
    }
</style>

<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari menu favoritmu...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="Masukkan kata kunci makanan..." aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3 bg-primary text-white" style="cursor: pointer;"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->

<!-- Hero Section Start -->
<div class="container-fluid hero-section py-5 mb-5" style="margin-top: 90px;">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7" data-aos="fade-right">
                <h6 class="text-uppercase fw-bold mb-3" style="color: var(--nesa-accent); letter-spacing: 2px;">⚡ KANTIN SEKOLAH DIGITAL</h6>
                <h1 class="display-3 fw-bold mb-4" style="color: var(--nesa-dark); line-height: 1.1;">
                    <span id="typed-text"></span>
                </h1>
                <p class="lead text-secondary mb-5">Pesan makanan & minuman lezat favoritmu dari berbagai stand sekolah langsung ke kelas dengan cepat, higienis, dan terjangkau.</p>
                <div class="d-flex gap-3">
                    <a href="#kategori-menu" class="btn btn-nesa btn-nesa-primary px-4 py-3"><i class="fas fa-utensils me-2"></i> Jelajahi Menu</a>
                    <a href="{{ url('/aboutus') }}" class="btn btn-nesa btn-nesa-outline px-4 py-3"><i class="fas fa-info-circle me-2"></i> Tentang Kami</a>
                </div>
            </div>
            <div class="col-md-12 col-lg-5" data-aos="fade-left">
                <div id="carouselId" class="carousel slide position-relative shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/Ayam Geprek.jpg" class="d-block w-100" style="height: 380px; object-fit: cover;" alt="Ayam Geprek">
                            <div class="carousel-caption d-md-block bg-dark bg-opacity-60 rounded-3 p-3 m-3">
                                <h5 class="text-white mb-0 fw-bold">Ayam Geprek Mozzarella</h5>
                                <p class="text-white-50 small mb-0">Renyah, gurih, dan keju melimpah.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/Ayam Teriyaki.jpg" class="d-block w-100" style="height: 380px; object-fit: cover;" alt="Ayam Teriyaki">
                            <div class="carousel-caption d-md-block bg-dark bg-opacity-60 rounded-3 p-3 m-3">
                                <h5 class="text-white mb-0 fw-bold">Chicken Bento Teriyaki</h5>
                                <p class="text-white-50 small mb-0">Rasa manis oriental yang berkesan.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/Mie Ayam.jpg" class="d-block w-100" style="height: 380px; object-fit: cover;" alt="Mie Ayam">
                            <div class="carousel-caption d-md-block bg-dark bg-opacity-60 rounded-3 p-3 m-3">
                                <h5 class="text-white mb-0 fw-bold">Mie Ayam Pangsit</h5>
                                <p class="text-white-50 small mb-0">Kenyal dengan kaldu gurih tradisional.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<!-- "Why Choose Us" & Stats Section Start -->
<div class="container py-5">
    <!-- Value Propositions -->
    <div class="text-center mb-5" data-aos="fade-up">
        <h6 class="text-uppercase fw-bold" style="color: var(--nesa-accent); letter-spacing: 2px;">KEUNGGULAN KAMI</h6>
        <h2 class="fw-bold text-dark display-6">Mengapa Memilih NesaFood?</h2>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-leaf"></i></div>
                <h5 class="fw-bold text-dark mb-2">Bahan Selalu Segar</h5>
                <p class="text-muted small mb-0">Makanan diolah langsung menggunakan bahan-bahan terbaik, bersih, dan higienis demi kesehatan Anda.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-shipping-fast"></i></div>
                <h5 class="fw-bold text-dark mb-2">Pengantaran Cepat</h5>
                <p class="text-muted small mb-0">Sistem terintegrasi memastikan pesanan Anda tiba di kelas atau meja dalam keadaan hangat dan lezat.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-tags"></i></div>
                <h5 class="fw-bold text-dark mb-2">Harga Ramah Kantong</h5>
                <p class="text-muted small mb-0">Nikmati cita rasa kuliner berkualitas tinggi dengan harga yang sangat bersahabat bagi pelajar.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-wallet"></i></div>
                <h5 class="fw-bold text-dark mb-2">Pembayaran Cashless</h5>
                <p class="text-muted small mb-0">Transaksi aman dan praktis menggunakan QRIS, e-wallet, atau potongan saldo NesaFood langsung.</p>
            </div>
        </div>
    </div>

    <!-- Statistics Banner -->
    <div class="stats-banner" data-aos="zoom-in">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <h2 class="display-5 fw-bold text-white mb-1">15+</h2>
                <p class="text-white-50 mb-0 font-semibold" style="font-size: 0.9rem;">Stand Pilihan</p>
            </div>
            <div class="col-6 col-md-3">
                <h2 class="display-5 fw-bold text-white mb-1">100+</h2>
                <p class="text-white-50 mb-0 font-semibold" style="font-size: 0.9rem;">Varian Menu Lezat</p>
            </div>
            <div class="col-6 col-md-3">
                <h2 class="display-5 fw-bold text-white mb-1">4.9★</h2>
                <p class="text-white-50 mb-0 font-semibold" style="font-size: 0.9rem;">Rating Kepuasan</p>
            </div>
            <div class="col-6 col-md-3">
                <h2 class="display-5 fw-bold text-white mb-1">5 Mnt</h2>
                <p class="text-white-50 mb-0 font-semibold" style="font-size: 0.9rem;">Waktu Antar Rata-rata</p>
            </div>
        </div>
    </div>
</div>
<!-- "Why Choose Us" & Stats Section End -->

<!-- Dynamic Categories Showcase Start -->
<div id="kategori-menu" class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4 align-items-center mb-5">
                <div class="col-lg-5 text-start" data-aos="fade-right">
                    <h6 class="text-uppercase fw-bold mb-2" style="color: var(--nesa-accent); letter-spacing: 2px;">📖 MENU PILIHAN KAMI</h6>
                    <h2 class="fw-bold text-dark display-6 mb-0">Eksplorasi Rasa di NesaFood</h2>
                </div>
                <div class="col-lg-7 text-end" data-aos="fade-left">
                    <ul class="nav nav-pills d-inline-flex justify-content-end text-center p-2 bg-white rounded-pill shadow-sm">
                        <li class="nav-item">
                            <a class="nav-link category-chip active" data-bs-toggle="pill" href="#tab-1">Semua Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link category-chip" data-bs-toggle="pill" href="#tab-2">Makanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link category-chip" data-bs-toggle="pill" href="#tab-3">Minuman</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="tab-content">
                <!-- TAB 1: ALL MENU -->
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4 justify-content-center">
                        @forelse($allMenus->take(8) as $index => $item)
                            <div class="col-md-6 col-lg-4 col-xl-3" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                                <div class="card card-product h-100 d-flex flex-column">
                                    <div class="img-wrapper">
                                        <img src="{{ asset(getMenuImage($item->name)) }}" alt="{{ $item->name }}">
                                        <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow-sm" 
                                              style="background-color: var(--nesa-accent); font-size: 0.8rem; font-weight:700;">
                                            {{ ucfirst($item->type) }}
                                        </span>
                                    </div>
                                    <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1">
                                        <div>
                                            <small class="text-primary fw-bold mb-1 d-block"><i class="fas fa-store me-1"></i> {{ $item->stand->name ?? 'Stand Sekolah' }}</small>
                                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1.05rem;">{{ $item->name }}</h5>
                                            <p class="text-muted small mb-3">{{ $item->description ?? 'Deskripsi rasa khas kuliner sekolah pilihan.' }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                            <span class="fs-5 fw-bold text-dark">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            <a href="#" class="btn btn-nesa btn-nesa-outline btn-sm py-2 btn-add-to-cart"
                                               data-id="{{ $item->id }}"
                                               data-name="{{ $item->name }}"
                                               data-price="{{ $item->price }}"
                                               data-image="{{ asset(getMenuImage($item->name)) }}">
                                                <i class="fa fa-shopping-bag me-1"></i> Beli
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada menu yang tersedia saat ini.</p>
                        @endforelse
                    </div>
                </div>

                <!-- TAB 2: FOOD ONLY -->
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4 justify-content-center">
                        @forelse($foods as $index => $item)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card card-product h-100 d-flex flex-column">
                                    <div class="img-wrapper">
                                        <img src="{{ asset(getMenuImage($item->name)) }}" alt="{{ $item->name }}">
                                        <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow-sm" 
                                              style="background-color: var(--nesa-accent); font-size: 0.8rem; font-weight:700;">
                                            Makanan
                                        </span>
                                    </div>
                                    <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1">
                                        <div>
                                            <small class="text-primary fw-bold mb-1 d-block"><i class="fas fa-store me-1"></i> {{ $item->stand->name ?? 'Stand Sekolah' }}</small>
                                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1.05rem;">{{ $item->name }}</h5>
                                            <p class="text-muted small mb-3">{{ $item->description ?? 'Nikmati hidangan lezat dan mengenyangkan.' }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                            <span class="fs-5 fw-bold text-dark">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            <a href="#" class="btn btn-nesa btn-nesa-outline btn-sm py-2 btn-add-to-cart"
                                               data-id="{{ $item->id }}"
                                               data-name="{{ $item->name }}"
                                               data-price="{{ $item->price }}"
                                               data-image="{{ asset(getMenuImage($item->name)) }}">
                                                <i class="fa fa-shopping-bag me-1"></i> Beli
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada makanan yang tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <!-- TAB 3: DRINKS ONLY -->
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4 justify-content-center">
                        @forelse($drinks as $index => $item)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card card-product h-100 d-flex flex-column">
                                    <div class="img-wrapper">
                                        <img src="{{ asset('img/best-product-6.jpg') }}" alt="{{ $item->name }}">
                                        <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow-sm" 
                                              style="background-color: var(--nesa-accent); font-size: 0.8rem; font-weight:700;">
                                            Minuman
                                        </span>
                                    </div>
                                    <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1">
                                        <div>
                                            <small class="text-primary fw-bold mb-1 d-block"><i class="fas fa-store me-1"></i> {{ $item->stand->name ?? 'Stand Sekolah' }}</small>
                                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1.05rem;">{{ $item->name }}</h5>
                                            <p class="text-muted small mb-3">{{ $item->description ?? 'Lepaskan dahagamu dengan kesegaran murni ini.' }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                            <span class="fs-5 fw-bold text-dark">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            <a href="#" class="btn btn-nesa btn-nesa-outline btn-sm py-2 btn-add-to-cart"
                                               data-id="{{ $item->id }}"
                                               data-name="{{ $item->name }}"
                                               data-price="{{ $item->price }}"
                                               data-image="{{ asset('img/best-product-6.jpg') }}">
                                                <i class="fa fa-shopping-bag me-1"></i> Beli
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada minuman yang tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<!-- Dynamic Categories Showcase End -->

<!-- Promo Section Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-uppercase fw-bold" style="color: var(--nesa-accent); letter-spacing: 2px;">⚡ PROMO SPESIAL</h6>
            <h2 class="fw-bold text-dark display-6">Penawaran Menarik Minggu Ini</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">Jangan lewatkan diskon spektakuler dan layanan gratis ongkir khusus untuk menu pilihan dari stand favoritmu.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Promo 1 -->
            <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="promo-card">
                    <img src="img/Gado-Gado copy.jpg" class="w-100" style="height: 220px; object-fit:cover;" alt="Gado-Gado Promo">
                    <div class="p-4 text-center">
                        <span class="badge bg-danger mb-2 px-3 py-2 rounded-pill font-bold">HEMAT 20%</span>
                        <h4 class="fw-bold text-dark mb-2">Gado-Gado Spesial</h4>
                        <p class="text-muted small mb-0">Nikmati porsi melimpah dengan kuah kacang kental dan renyah.</p>
                    </div>
                </div>
            </div>

            <!-- Promo 2 -->
            <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="promo-card">
                    <img src="img/Ayam Geprek.jpg" class="w-100" style="height: 220px; object-fit:cover;" alt="Ayam Geprek Promo">
                    <div class="p-4 text-center">
                        <span class="badge bg-success mb-2 px-3 py-2 rounded-pill font-bold">GRATIS ONGKIR</span>
                        <h4 class="fw-bold text-dark mb-2">Ayam Geprek Gacor</h4>
                        <p class="text-muted small mb-0">Gratis layanan antar langsung ke depan kelas tanpa minimal beli.</p>
                    </div>
                </div>
            </div>

            <!-- Promo 3 -->
            <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="promo-card">
                    <img src="img/Ayam Teriyaki copy.jpg" class="w-100" style="height: 220px; object-fit:cover;" alt="Ayam Teriyaki Promo">
                    <div class="p-4 text-center">
                        <span class="badge bg-danger mb-2 px-3 py-2 rounded-pill font-bold">DISKON 10%</span>
                        <h4 class="fw-bold text-dark mb-2">Ayam Teriyaki Premium</h4>
                        <p class="text-muted small mb-0">Daging ayam empuk berlapis saus teriyaki gurih & salad segar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Promo Section End -->

<!-- Bestseller Product Start -->
<div class="container py-5 border-top">
    <div class="text-center mb-5" data-aos="fade-up">
        <h6 class="text-uppercase fw-bold" style="color: var(--nesa-accent); letter-spacing: 2px;">🔥 PALING DISUKAI</h6>
        <h2 class="fw-bold text-dark display-6 mb-2">Menu Terlaris Pembeli</h2>
        <p class="text-muted">Berbagai hidangan favorit yang menjadi jawara di kantin sekolah. Terbukti memuaskan!</p>
    </div>
    
    <div class="row g-4 justify-content-center">
        @forelse ($bestsellers as $index => $item)
            @php
                $itemImage = getMenuImage($item->name);
                if ($item->type === 'minuman') {
                    $itemImage = 'img/best-product-6.jpg';
                }
            @endphp
            <div class="col-md-6 col-xl-4" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                <div class="bestseller-item p-4 bg-white border border-light shadow-sm h-100">
                    <div class="row align-items-center g-0">
                        <div class="col-5 text-center">
                            <img src="{{ asset($itemImage) }}" alt="{{ $item->name }}" class="img-fluid rounded-circle shadow-sm" style="width: 110px; height: 110px; object-fit: cover;">
                        </div>
                        <div class="col-7 ps-3">
                            <small class="text-muted uppercase font-bold" style="font-size: 0.75rem;">🌟 Best Seller</small>
                            <h5 class="fw-bold text-dark mb-1" style="font-size: 1rem;">{{ $item->name }}</h5>
                            <div class="d-flex align-items-center mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star text-warning" style="font-size: 0.8rem;"></i>
                                @endfor
                            </div>
                            <h6 class="text-primary fw-bold mb-3">Rp {{ number_format($item->price, 0, ',', '.') }}</h6>
                            <a href="#"
                               class="btn btn-nesa btn-nesa-outline btn-sm py-1 px-3 btn-add-to-cart"
                               data-id="{{ $item->id }}"
                               data-name="{{ $item->name }}"
                               data-price="{{ $item->price }}"
                               data-image="{{ asset($itemImage) }}">
                                <i class="fa fa-shopping-bag me-1"></i> Beli
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada menu terlaris.</p>
        @endforelse
    </div>
</div>
<!-- Bestseller Product End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init();
</script>

<script>
    var typed = new Typed('#typed-text', {
        strings: [
            "Nikmati Hidangan Favoritmu!",
            "Pesan Instan Langsung Ke Kelas!",
            "Enak, Murah, Higienis!"
        ],
        typeSpeed: 60,
        backSpeed: 30,
        backDelay: 1500,
        startDelay: 500,
        loop: true,
        showCursor: true,
        cursorChar: "|"
    });
</script>

<script>
    const isLoggedIn = JSON.parse('@json(Auth::check())');

    $(document).ready(function () {
        // Add to Cart (Hindari multiple binding)
        $(document).off('click', '.btn-add-to-cart').on('click', '.btn-add-to-cart', function (e) {
            e.preventDefault();

            if (!isLoggedIn) {
                alert("Silakan login terlebih dahulu untuk menambahkan ke keranjang.");
                window.location.href = "/auth/login";
                return;
            }

            const menuId = $(this).data('id');
            const menuName = $(this).data('name');
            const menuPrice = $(this).data('price');
            const menuImage = $(this).data('image');

            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: menuId,
                    name: menuName,
                    price: menuPrice,
                    image: menuImage
                },
                success: function (response) {
                    alert(response.message);
                    $('.cart-count').text(response.cartCount).removeClass('d-none').addClass('d-flex');
                },
                error: function (xhr) {
                    alert("Gagal menambahkan ke keranjang.");
                }
            });
        });
    });
</script>
@endsection
