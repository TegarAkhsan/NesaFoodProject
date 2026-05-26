@extends('layouts.app')
@section('title', 'NesaFood - ' . $stand->name)
@section('content')

<style>
    /* Custom Modern Styles for Stand Detail */
    .stand-hero {
        background: linear-gradient(135deg, rgba(27, 67, 50, 0.95) 0%, rgba(15, 36, 26, 0.98) 100%), url("{{ asset('img/banner-fruits.jpg') }}");
        background-position: center;
        background-size: cover;
        padding: 140px 0 100px 0;
        margin-top: 90px;
        position: relative;
        overflow: hidden;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
    }
    .stand-hero::before {
        content: '';
        position: absolute;
        top: -20%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(129, 196, 8, 0.15) 0%, transparent 60%);
        border-radius: 50%;
        filter: blur(40px);
    }
    .stand-hero::after {
        content: '';
        position: absolute;
        bottom: -10%;
        right: -5%;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(255, 140, 0, 0.12) 0%, transparent 60%);
        border-radius: 50%;
        filter: blur(40px);
    }
    .hero-floating-food {
        position: relative;
        animation: floatAnimation 6s ease-in-out infinite;
        max-height: 380px;
        object-fit: contain;
    }
    @keyframes floatAnimation {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-15px) rotate(2deg);
        }
    }
    .badge-yellow {
        background: #ffe4c4;
        color: var(--nesa-accent);
        padding: 8px 18px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 1px;
        display: inline-block;
    }
    .badge-modern {
        background: rgba(129, 196, 8, 0.1);
        color: var(--nesa-primary);
        border: 1px solid rgba(129, 196, 8, 0.2);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    .trust-pill {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 15px 25px;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .trust-pill i {
        font-size: 1.5rem;
        color: var(--nesa-primary);
    }
    
    /* Horizontal Circular Categories Selector */
    .category-circle-nav {
        display: flex;
        justify-content: center;
        gap: 25px;
        margin-bottom: 50px;
    }
    .category-circle-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .circle-icon-wrapper {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.03);
        border: 2px solid transparent;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .category-circle-btn span {
        margin-top: 12px;
        font-weight: 700;
        color: #4a5568;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    .category-circle-btn:hover .circle-icon-wrapper {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 12px 25px rgba(27, 67, 50, 0.08);
        background-color: #ffffff;
        border-color: var(--nesa-primary);
    }
    .category-circle-btn.active .circle-icon-wrapper {
        background: linear-gradient(135deg, var(--nesa-primary) 0%, var(--nesa-primary-hover) 100%);
        color: #ffffff !important;
        box-shadow: 0 10px 25px rgba(129, 196, 8, 0.25);
        border-color: var(--nesa-primary);
    }
    .category-circle-btn.active span {
        color: var(--nesa-primary);
    }

    /* Product Cards Modern Redesign */
    .card-modern-product {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.02);
        box-shadow: var(--nesa-card-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .card-modern-product:hover {
        transform: translateY(-8px);
        box-shadow: var(--nesa-card-hover);
        border-color: rgba(129, 196, 8, 0.15);
    }
    .product-img-container {
        position: relative;
        padding-top: 68%;
        background-color: #f7fafc;
        overflow: hidden;
    }
    .product-img-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }
    .card-modern-product:hover .product-img-container img {
        transform: scale(1.06);
    }
    .product-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }
    .card-body-modern {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .card-body-modern h5 {
        font-weight: 750;
        color: var(--nesa-dark);
        margin-bottom: 8px;
        font-size: 1.15rem;
    }
    .card-body-modern .desc {
        font-size: 0.88rem;
        color: #718096;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }
    .card-footer-modern {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }
    .price-text {
        font-weight: 800;
        font-size: 1.25rem;
        color: var(--nesa-dark);
        margin-bottom: 0;
    }
    .btn-buy-modern {
        background-color: var(--nesa-accent);
        color: #ffffff;
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 700;
        font-size: 0.9rem;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-buy-modern:hover {
        background-color: #e07b00;
        color: #ffffff;
        box-shadow: 0 5px 15px rgba(255, 140, 0, 0.3);
        transform: translateY(-1px);
    }

    /* Quantity input mockup styling matching mockup 2 */
    .qty-selector-mockup {
        display: flex;
        align-items: center;
        background: #f7fafc;
        border-radius: 10px;
        padding: 2px;
        border: 1px solid #edf2f7;
    }
    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        background: #ffffff;
        color: #4a5568;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        cursor: pointer;
    }
    .qty-val {
        padding: 0 12px;
        font-weight: 700;
        font-size: 0.9rem;
        color: #2d3748;
    }

    /* Info / Delivery Grid */
    .delivery-section {
        background: #ffffff;
        border-radius: 30px;
        border: 1px solid rgba(0,0,0,0.02);
        box-shadow: var(--nesa-card-shadow);
        overflow: hidden;
        margin-top: 80px;
        margin-bottom: 50px;
    }
    .delivery-content {
        padding: 50px;
    }
    .delivery-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background-color: var(--nesa-primary-light);
        color: var(--nesa-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
</style>

<!-- Hero Section Start -->
<div class="container-fluid stand-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge-yellow mb-3 text-uppercase">⚡ HIGIENIS & KILAT</span>
                <h1 class="text-white display-4 fw-bold mb-3 leading-tight">Selamat Datang di<br><span style="color: var(--nesa-primary);">{{ $stand->name }}</span></h1>
                <p class="text-white-50 fs-5 mb-4 leading-relaxed">
                    {{ $stand->description }}
                </p>
                <div class="mt-4 d-flex flex-wrap gap-3">
                    <a href="#menu-catalog" class="btn btn-buy-modern btn-lg px-4 py-3 rounded-pill text-uppercase fw-bold text-white"><i class="fas fa-search me-2"></i>Jelajahi Menu</a>
                    <a href="#delivery-info" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill text-uppercase fw-bold"><i class="fas fa-truck me-2"></i>Info Delivery</a>
                </div>
            </div>
            <div class="col-lg-5 text-center" data-aos="fade-left">
                <!-- Floating street food illustration banner cutout -->
                <img src="{{ asset('img/hero-img-1.png') }}" class="img-fluid hero-floating-food" alt="{{ $stand->name }} Banner">
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="row g-4 mt-5">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="trust-pill">
                    <i class="fas fa-hamburger"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Street Food Segar</h6>
                        <span class="text-white-50 small">Bahan pilihan terbaik</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="trust-pill">
                    <i class="fas fa-hand-sparkles"></i>
                    <div>
                        <h6 class="fw-bold mb-0">100% Bersih & Halal</h6>
                        <span class="text-white-50 small">Standar higienis tinggi</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="trust-pill">
                    <i class="fas fa-shipping-fast"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Pengantaran Instan</h6>
                        <span class="text-white-50 small">Langsung sampai tujuan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<!-- Popular / Featured Dishes Start -->
<div class="container py-5 mt-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge-premium mb-2">TERLARIS</span>
        <h2 class="fw-bold text-dark display-6">Menu Paling Direkomendasikan</h2>
        <p class="text-muted">Cita rasa juara yang paling sering dipesan oleh pelanggan kami.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- Render up to 3 featured menus (first 3 foods or drinks) -->
        @php $featuredCount = 0; @endphp
        
        @if(isset($foods) && count($foods) > 0)
            @foreach($foods->take(2) as $item)
                @php
                    $featuredCount++;
                    // Dynamic image mapping
                    $menuImage = 'img/default-food.jpg';
                    $lowercaseName = strtolower($item->name);
                    if (str_contains($lowercaseName, 'bakar')) {
                        $menuImage = 'img/Ayam Bakar.jpg';
                    } elseif (str_contains($lowercaseName, 'geprek')) {
                        $menuImage = 'img/Ayam Geprek.jpg';
                    } elseif (str_contains($lowercaseName, 'goreng') || str_contains($lowercaseName, 'mie')) {
                        $menuImage = 'img/Nasi Goreng.jpg';
                    } elseif (str_contains($lowercaseName, 'sate')) {
                        $menuImage = 'img/best-product-3.jpg';
                    }
                @endphp
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $featuredCount * 100 }}">
                    <div class="card-modern-product">
                        <div class="product-img-container">
                            <span class="product-badge badge-yellow">🔥 TOP REKOMENDASI</span>
                            <img src="{{ asset($menuImage) }}" alt="{{ $item->name }}">
                        </div>
                        <div class="card-body-modern">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge-modern">Makanan</span>
                                <div class="text-warning small">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <h5>{{ $item->name }}</h5>
                            <p class="desc">{{ $item->description }}</p>
                            <div class="card-footer-modern">
                                <span class="price-text">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                <button class="btn-buy-modern btn-add-to-cart"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    data-price="{{ $item->price }}"
                                    data-image="{{ asset($menuImage) }}">
                                    <i class="fas fa-shopping-basket me-2"></i>Beli
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        @if(isset($drinks) && count($drinks) > 0)
            @foreach($drinks->take(1) as $item)
                @php
                    $featuredCount++;
                    // Dynamic image mapping
                    $menuImage = 'img/default-drink.jpg';
                    $lowercaseName = strtolower($item->name);
                    if (str_contains($lowercaseName, 'alpukat')) {
                        $menuImage = 'img/Jus Alpukat.jpg';
                    } elseif (str_contains($lowercaseName, 'teh')) {
                        $menuImage = 'img/fruite-item-1.jpg';
                    } elseif (str_contains($lowercaseName, 'jeruk')) {
                        $menuImage = 'img/fruite-item-2.jpg';
                    } elseif (str_contains($lowercaseName, 'kopi')) {
                        $menuImage = 'img/fruite-item-3.jpg';
                    }
                @endphp
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $featuredCount * 100 }}">
                    <div class="card-modern-product">
                        <div class="product-img-container">
                            <span class="product-badge badge-yellow" style="background: rgba(255, 140, 0, 0.1); color: var(--nesa-accent);">🍹 BEST SELLER</span>
                            <img src="{{ asset($menuImage) }}" alt="{{ $item->name }}">
                        </div>
                        <div class="card-body-modern">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge-modern" style="color: var(--nesa-accent); background: rgba(255, 140, 0, 0.08); border-color: rgba(255, 140, 0, 0.15);">Minuman</span>
                                <div class="text-warning small">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <h5>{{ $item->name }}</h5>
                            <p class="desc">{{ $item->description }}</p>
                            <div class="card-footer-modern">
                                <span class="price-text">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                <button class="btn-buy-modern btn-add-to-cart"
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}"
                                    data-price="{{ $item->price }}"
                                    data-image="{{ asset($menuImage) }}">
                                    <i class="fas fa-shopping-basket me-2"></i>Beli
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<!-- Popular / Featured End -->

<!-- Dynamic Catalog Section Start -->
<div id="menu-catalog" class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-premium mb-2">DAFTAR MENU</span>
            <h2 class="fw-bold text-dark display-6">Jelajahi Menu Pilihan Kami</h2>
            <p class="text-muted">Gunakan pemilih kategori di bawah ini untuk melihat menu terbaik kami.</p>
        </div>

        <!-- Dynamic Circular Category Selector matching mockup 2 -->
        <div class="category-circle-nav" data-aos="fade-up">
            <a href="#food-pane" class="category-circle-btn active" data-bs-toggle="tab">
                <div class="circle-icon-wrapper" style="color: var(--nesa-primary);">
                    🍕
                </div>
                <span>MAKANAN</span>
            </a>
            <a href="#drink-pane" class="category-circle-btn" data-bs-toggle="tab">
                <div class="circle-icon-wrapper" style="color: var(--nesa-accent);">
                    🍹
                </div>
                <span>MINUMAN</span>
            </a>
        </div>

        <!-- Catalog Tab Contents -->
        <div class="tab-content">
            <!-- Makanan Pane -->
            <div id="food-pane" class="tab-pane fade show active">
                @if(isset($foods) && count($foods) > 0)
                    <div class="row g-4">
                        @foreach($foods as $index => $item)
                            @php
                                // Dynamic image mapping
                                $menuImage = 'img/default-food.jpg';
                                $lowercaseName = strtolower($item->name);
                                if (str_contains($lowercaseName, 'bakar')) {
                                    $menuImage = 'img/Ayam Bakar.jpg';
                                } elseif (str_contains($lowercaseName, 'geprek')) {
                                    $menuImage = 'img/Ayam Geprek.jpg';
                                } elseif (str_contains($lowercaseName, 'goreng') || str_contains($lowercaseName, 'mie')) {
                                    $menuImage = 'img/Mie Goreng Jawa.jpg';
                                    if (str_contains($lowercaseName, 'nasi')) {
                                        $menuImage = 'img/Nasi Goreng.jpg';
                                    }
                                } elseif (str_contains($lowercaseName, 'sate')) {
                                    $menuImage = 'img/best-product-3.jpg';
                                } elseif (str_contains($lowercaseName, 'bakso')) {
                                    $menuImage = 'img/best-product-4.jpg';
                                } elseif (str_contains($lowercaseName, 'soto')) {
                                    $menuImage = 'img/fruite-item-4.jpg';
                                } elseif (str_contains($lowercaseName, 'tahu') || str_contains($lowercaseName, 'tek')) {
                                    $menuImage = 'img/Gado-Gado.jpg';
                                }
                            @endphp
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                                <div class="card-modern-product">
                                    <div class="product-img-container">
                                        <span class="product-badge badge-modern bg-white text-dark">⭐ Popular</span>
                                        <img src="{{ asset($menuImage) }}" alt="{{ $item->name }}">
                                    </div>
                                    <div class="card-body-modern">
                                        <h5>{{ $item->name }}</h5>
                                        <p class="desc">{{ $item->description }}</p>
                                        <div class="card-footer-modern">
                                            <span class="price-text">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            
                                            <!-- Quantity Look-alike mockup selector + Buy btn -->
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="qty-selector-mockup">
                                                    <button class="qty-btn dec-btn">-</button>
                                                    <span class="qty-val">1</span>
                                                    <button class="qty-btn inc-btn">+</button>
                                                </div>
                                                <button class="btn-buy-modern btn-add-to-cart"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}"
                                                    data-price="{{ $item->price }}"
                                                    data-image="{{ asset($menuImage) }}">
                                                    Beli
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Belum ada menu makanan tersedia.</p>
                @endif
            </div>

            <!-- Minuman Pane -->
            <div id="drink-pane" class="tab-pane fade">
                @if(isset($drinks) && count($drinks) > 0)
                    <div class="row g-4">
                        @foreach($drinks as $index => $item)
                            @php
                                // Dynamic image mapping
                                $menuImage = 'img/default-drink.jpg';
                                $lowercaseName = strtolower($item->name);
                                if (str_contains($lowercaseName, 'alpukat')) {
                                    $menuImage = 'img/Jus Alpukat.jpg';
                                } elseif (str_contains($lowercaseName, 'teh')) {
                                    $menuImage = 'img/fruite-item-1.jpg';
                                } elseif (str_contains($lowercaseName, 'jeruk')) {
                                    $menuImage = 'img/fruite-item-2.jpg';
                                } elseif (str_contains($lowercaseName, 'kopi')) {
                                    $menuImage = 'img/fruite-item-3.jpg';
                                } elseif (str_contains($lowercaseName, 'milkshake') || str_contains($lowercaseName, 'coklat')) {
                                    $menuImage = 'img/fruite-item-5.jpg';
                                } elseif (str_contains($lowercaseName, 'lemon') || str_contains($lowercaseName, 'matcha') || str_contains($lowercaseName, 'thai')) {
                                    $menuImage = 'img/fruite-item-6.jpg';
                                }
                            @endphp
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                                <div class="card-modern-product">
                                    <div class="product-img-container">
                                        <span class="product-badge badge-modern bg-white text-dark" style="color: var(--nesa-accent);">⭐ Segar</span>
                                        <img src="{{ asset($menuImage) }}" alt="{{ $item->name }}">
                                    </div>
                                    <div class="card-body-modern">
                                        <h5>{{ $item->name }}</h5>
                                        <p class="desc">{{ $item->description }}</p>
                                        <div class="card-footer-modern">
                                            <span class="price-text">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            
                                            <!-- Quantity Look-alike mockup selector + Buy btn -->
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="qty-selector-mockup">
                                                    <button class="qty-btn dec-btn">-</button>
                                                    <span class="qty-val">1</span>
                                                    <button class="qty-btn inc-btn">+</button>
                                                </div>
                                                <button class="btn-buy-modern btn-add-to-cart"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}"
                                                    data-price="{{ $item->price }}"
                                                    data-image="{{ asset($menuImage) }}">
                                                    Beli
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Belum ada menu minuman tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Dynamic Catalog End -->

<!-- Info & Delivery Map Section matching mockup 2 -->
<div id="delivery-info" class="container py-4" data-aos="fade-up">
    <div class="delivery-section">
        <div class="row g-0 align-items-center">
            <div class="col-lg-6 delivery-content">
                <span class="badge-premium mb-2">⚡ PENGANTARAN KAMPUS</span>
                <h2 class="fw-bold text-dark display-6 mb-4">Metode & Info Pengantaran</h2>
                <p class="text-muted leading-relaxed mb-4">Kami menyediakan kemudahan memesan makanan favorit langsung ke gedung kelas Anda di lingkungan Universitas Negeri Surabaya.</p>
                
                <div class="d-flex gap-3 align-items-start mb-4">
                    <div class="delivery-icon-box">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Pemesanan Online Cepat</h6>
                        <span class="text-muted small">Pilih menu, isi catatan lokasi kelas, dan selesaikan transaksi secara instan.</span>
                    </div>
                </div>

                <div class="d-flex gap-3 align-items-start mb-4">
                    <div class="delivery-icon-box" style="color: var(--nesa-accent); background: rgba(255, 140, 0, 0.08);">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Pembayaran Cashless Terintegrasi</h6>
                        <span class="text-muted small">Mendukung pembayaran aman via QRIS, e-wallet, atau potong saldo instan.</span>
                    </div>
                </div>

                <div class="d-flex gap-3 align-items-start">
                    <div class="delivery-icon-box">
                        <i class="fas fa-route"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Area Pengantaran Bebas Ongkir</h6>
                        <span class="text-muted small">Khusus melayani seluruh gedung, ruang kelas, laboratorium, dan kantor di UNESA Ketintang.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center bg-light p-5" style="border-top-right-radius: 30px; border-bottom-right-radius: 30px; min-height: 480px; display: flex; align-items: center; justify-content: center;">
                <!-- Premium delivery illustration asset generated earlier -->
                <div class="p-3" style="max-width: 480px;">
                    <img src="{{ asset('img/delivery_illustration.png') }}" class="img-fluid rounded-4 shadow-sm" alt="UNESA Delivery Area Map Mockup">
                    <span class="text-muted small mt-3 d-block">Ilustrasi Pengantaran Kantin Digital NesaFood</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delivery Info End -->

<!-- Custom Interactive JS script for the quantity selector look-alike -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle categories circular tabs switching
        const circleBtns = document.querySelectorAll('.category-circle-btn');
        circleBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                circleBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const targetPaneId = this.getAttribute('href');
                const panes = document.querySelectorAll('.tab-content .tab-pane');
                panes.forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                const activePane = document.querySelector(targetPaneId);
                activePane.classList.add('show', 'active');
            });
        });

        // Handle quantity plus/minus dynamic interaction
        const incBtns = document.querySelectorAll('.inc-btn');
        const decBtns = document.querySelectorAll('.dec-btn');

        incBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const qtyValNode = this.parentNode.querySelector('.qty-val');
                let curVal = parseInt(qtyValNode.innerText);
                qtyValNode.innerText = curVal + 1;
            });
        });

        decBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const qtyValNode = this.parentNode.querySelector('.qty-val');
                let curVal = parseInt(qtyValNode.innerText);
                if (curVal > 1) {
                    qtyValNode.innerText = curVal - 1;
                }
            });
        });

        // AJAX Add to Cart (overriding to get correct local quantity counter values!)
        $(document).off('click', '.btn-add-to-cart').on('click', '.btn-add-to-cart', function (e) {
            e.preventDefault();

            // Check if user is logged in
            const isLoggedIn = JSON.parse('@json(Auth::check())');
            if (!isLoggedIn) {
                alert("Silakan login terlebih dahulu untuk menambahkan ke keranjang.");
                window.location.href = "/auth/login";
                return;
            }

            const menuId = $(this).data('id');
            const menuName = $(this).data('name');
            const menuPrice = $(this).data('price');
            const menuImage = $(this).data('image');

            // Find current quantity chosen in the mockup quantity selector (default to 1 if not present)
            const parentSelector = $(this).siblings('.qty-selector-mockup');
            let quantity = 1;
            if (parentSelector.length > 0) {
                quantity = parseInt(parentSelector.find('.qty-val').text()) || 1;
            }

            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: menuId,
                    name: menuName,
                    price: menuPrice,
                    image: menuImage,
                    quantity: quantity // Pass the custom quantity!
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