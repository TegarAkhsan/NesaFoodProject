@extends('layouts.app')
@section('title', 'NesaFood - Tentang Kami')
@section('content')

<style>
    .about-header {
        background: linear-gradient(135deg, rgba(27, 67, 50, 0.9) 0%, rgba(15, 36, 26, 0.95) 100%), url("{{ asset('img/cart-page-header-img.jpg') }}");
        background-position: center;
        background-size: cover;
        padding: 120px 0 80px 0;
        margin-top: 90px;
        position: relative;
        overflow: hidden;
    }
    .about-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 24px;
        background: #ffffff;
        clip-path: ellipse(60% 100% at 50% 100%);
    }
    .about-header-content {
        position: relative;
        z-index: 2;
    }
    .text-glow {
        text-shadow: 0 4px 12px rgba(129, 196, 8, 0.2);
    }
    .image-composition {
        position: relative;
        padding: 20px;
    }
    .image-composition img {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 4px solid #ffffff;
    }
    .image-composition:hover img {
        transform: scale(1.02) translateY(-4px);
    }
    .stats-card-overlay {
        position: absolute;
        bottom: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 25px 30px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(27, 67, 50, 0.12);
        border: 1px solid rgba(129, 196, 8, 0.2);
        z-index: 3;
        max-width: 250px;
    }
    .vision-card {
        border-radius: 20px;
        padding: 40px 30px;
        background-color: #ffffff;
        border-left: 6px solid var(--nesa-primary);
        height: 100%;
        box-shadow: var(--nesa-card-shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .vision-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, rgba(129, 196, 8, 0.05) 0%, transparent 70%);
        border-radius: 50%;
    }
    .vision-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--nesa-card-hover);
    }
    .value-card {
        background: #ffffff;
        padding: 45px 30px;
        border-radius: 24px;
        box-shadow: var(--nesa-card-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.02);
        height: 100%;
    }
    .value-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--nesa-card-hover);
        border-color: rgba(129, 196, 8, 0.15);
    }
    .value-icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 22px;
        background: var(--nesa-primary-light);
        color: var(--nesa-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 25px auto;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .value-card:hover .value-icon-wrapper {
        background: var(--nesa-primary);
        color: #ffffff;
        transform: rotate(8deg) scale(1.06);
        box-shadow: 0 10px 25px rgba(129, 196, 8, 0.25);
    }
    .cta-section {
        background: linear-gradient(135deg, var(--nesa-dark) 0%, #0f241a 100%);
        border-radius: 30px;
        padding: 70px 50px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(15, 36, 26, 0.18);
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(129, 196, 8, 0.15) 0%, transparent 60%);
        border-radius: 50%;
    }
    .cta-section::after {
        content: '';
        position: absolute;
        bottom: -40%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 140, 0, 0.12) 0%, transparent 60%);
        border-radius: 50%;
    }
    .cta-content {
        position: relative;
        z-index: 2;
    }
    .btn-nesa {
        background-color: var(--nesa-primary);
        color: #ffffff;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 12px 30px;
        border: 2px solid transparent;
    }
    .btn-nesa:hover {
        background-color: var(--nesa-primary-hover);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(129, 196, 8, 0.3);
    }
    .btn-nesa-outline {
        background-color: transparent;
        border-color: var(--nesa-primary);
        color: var(--nesa-primary);
    }
    .btn-nesa-outline:hover {
        background-color: var(--nesa-primary);
        color: #ffffff;
    }
    .btn-nesa-accent {
        background-color: var(--nesa-accent);
        color: #ffffff;
    }
    .btn-nesa-accent:hover {
        background-color: #e07b00;
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(255, 140, 0, 0.3);
    }
    .badge-premium {
        background: rgba(129, 196, 8, 0.1);
        color: var(--nesa-primary);
        border: 1px solid rgba(129, 196, 8, 0.2);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 1px;
        display: inline-block;
    }
    .leading-relaxed {
        line-height: 1.8;
    }
</style>

<!-- Page Header Start -->
<div class="container-fluid about-header text-center mb-5">
    <div class="about-header-content" data-aos="fade-down">
        <span class="badge-premium mb-3 bg-white text-dark">KANTIN DIGITAL KAMPUS</span>
        <h1 class="text-white display-4 fw-bold text-glow mb-3">Tentang NesaFood</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-white">Tentang Kami</li>
        </ol>
    </div>
</div>
<!-- Page Header End -->

<!-- About Story Section Start -->
<div class="container py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6" data-aos="fade-right">
            <span class="badge-premium mb-2">⚡ SIAPA KAMI</span>
            <h2 class="fw-bold text-dark display-6 mb-4">Revolusi Pemesanan Kuliner di Lingkungan Kampus</h2>
            <p class="text-muted leading-relaxed mb-4">
                <strong>NesaFood</strong> lahir dari visi inovatif untuk menghadirkan kenyamanan digital di area kampus. Kami menyadari betapa berharganya waktu istirahat mahasiswa dan civitas akademika UNESA yang seringkali habis hanya untuk mengantre makanan di kantin.
            </p>
            <p class="text-muted leading-relaxed mb-4">
                Dengan mengintegrasikan teknologi pemesanan digital (*e-ordering*), NesaFood memotong waktu antrean panjang dan mempertemukan Anda dengan puluhan stand kuliner terbaik secara instan langsung dari ponsel Anda.
            </p>
            <div class="mt-4">
                <a href="{{ url('/') }}" class="btn btn-nesa me-2"><i class="fas fa-utensils me-2"></i>Pesan Sekarang</a>
                <a href="{{ url('/contact') }}" class="btn btn-nesa btn-nesa-outline"><i class="fas fa-paper-plane me-2"></i>Hubungi Kami</a>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <div class="image-composition">
                <img src="{{ asset('img/single-item.jpg') }}" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 420px; object-fit: cover;" alt="NesaFood Story">
                
                <!-- Interactive stats box overlay -->
                <div class="stats-card-overlay d-none d-sm-block">
                    <div class="d-flex align-items-center mb-2">
                        <h3 class="fw-bold mb-0 text-primary me-2">10+</h3>
                        <span class="text-muted small leading-tight">Mitra Stand Kuliner</span>
                    </div>
                    <hr class="my-2" style="opacity: 0.1;">
                    <div class="d-flex align-items-center">
                        <h3 class="fw-bold mb-0" style="color: var(--nesa-accent);" class="me-2">100%</h3>
                        <span class="text-muted small leading-tight ms-2">Higienis & Halal</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Story Section End -->

<!-- Vision & Mission Section Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="vision-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-eye text-success fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-0">Visi Kami</h4>
                    </div>
                    <p class="text-muted mb-0 leading-relaxed">Menjadi pionir platform layanan pesan-antar makanan digital terbaik di lingkungan institusi pendidikan tinggi Indonesia, menciptakan ekosistem kantin digital yang modern, efisien, terpercaya, dan aman bagi seluruh civitas akademika.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="vision-card" style="border-left-color: var(--nesa-accent);">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255, 140, 0, 0.1);">
                            <i class="fas fa-bullseye fs-4" style="color: var(--nesa-accent);"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-0">Misi Kami</h4>
                    </div>
                    <ul class="text-muted mb-0 ps-3 leading-relaxed">
                        <li class="mb-2">Menghadirkan layanan pemesanan makanan & minuman secara praktis, cepat, dan mudah diakses kapan saja.</li>
                        <li class="mb-2">Membantu digitalisasi dan meningkatkan pertumbuhan ekonomi para mitra pedagang tenant / stand sekolah.</li>
                        <li>Menjaga kualitas kebersihan, kecepatan pengantaran, dan kepuasan pelanggan secara konsisten.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vision & Mission Section End -->

<!-- Core Values Section Start -->
<div class="container py-5 my-4">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge-premium mb-2">PRINSIP UTAMA</span>
        <h2 class="fw-bold text-dark display-6">Nilai Dasar NesaFood</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">Kami berkomitmen untuk selalu memberikan layanan terbaik berdasarkan pilar-pilar integritas berikut.</p>
    </div>

    <div class="row g-4 text-center">
        <!-- Value 1 -->
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="value-card">
                <div class="value-icon-wrapper">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h5 class="fw-bold text-dark mb-3">Pelayanan Tulus</h5>
                <p class="text-muted mb-0 small leading-relaxed">Kepuasan pelanggan dan kebahagiaan kuliner Anda adalah prioritas utama dari setiap baris kode dan langkah pengantaran kami.</p>
            </div>
        </div>
        <!-- Value 2 -->
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="value-card">
                <div class="value-icon-wrapper" style="color: var(--nesa-accent); background: rgba(255, 140, 0, 0.08);">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5 class="fw-bold text-dark mb-3">Kepercayaan & Keamanan</h5>
                <p class="text-muted mb-0 small leading-relaxed">Menjamin setiap pemesanan, pembayaran cashless, dan privasi akun Anda terlindungi dengan standar keamanan tinggi.</p>
            </div>
        </div>
        <!-- Value 3 -->
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="value-card">
                <div class="value-icon-wrapper">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h5 class="fw-bold text-dark mb-3">Inovasi Berkelanjutan</h5>
                <p class="text-muted mb-0 small leading-relaxed">Terus mengembangkan fitur digital modern yang intuitif demi memberikan pengalaman kuliner terbaik bagi Anda.</p>
            </div>
        </div>
    </div>
</div>
<!-- Core Values Section End -->

<!-- CTA Banner Section Start -->
<div class="container pb-5 mb-5" data-aos="zoom-in">
    <div class="cta-section text-center">
        <div class="cta-content mx-auto" style="max-width: 700px;">
            <h2 class="display-6 fw-bold text-white mb-3">Lapar di Sela Jam Kuliah?</h2>
            <p class="text-white-50 mb-4 fs-5 leading-relaxed">
                Jelajahi menu kuliner terenak dari berbagai stand pilihan di UNESA sekarang juga. Cepat, cashless, dan langsung diantar ke lokasi Anda!
            </p>
            <a href="{{ url('/') }}" class="btn btn-nesa btn-nesa-accent btn-lg px-5 py-3 rounded-pill text-uppercase fw-bold"><i class="fas fa-shopping-cart me-2"></i>Mulai Pesan Sekarang</a>
        </div>
    </div>
</div>
<!-- CTA Banner Section End -->

@endsection
