@extends('layouts.app')
@section('title', 'NesaFood - Hubungi Kami')
@section('content')

<style>
    .contact-header {
        background: linear-gradient(135deg, rgba(27, 67, 50, 0.9) 0%, rgba(15, 36, 26, 0.95) 100%), url("{{ asset('img/cart-page-header-img.jpg') }}");
        background-position: center;
        background-size: cover;
        padding: 120px 0 80px 0;
        margin-top: 90px;
        position: relative;
        overflow: hidden;
    }
    .contact-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 24px;
        background: #ffffff;
        clip-path: ellipse(60% 100% at 50% 100%);
    }
    .contact-header-content {
        position: relative;
        z-index: 2;
    }
    .text-glow {
        text-shadow: 0 4px 12px rgba(129, 196, 8, 0.2);
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
    .info-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.02) !important;
        border-radius: 16px !important;
    }
    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(27, 67, 50, 0.06) !important;
        border-color: rgba(129, 196, 8, 0.15) !important;
    }
    .icon-circle {
        transition: all 0.3s ease;
    }
    .info-card:hover .icon-circle {
        background-color: var(--nesa-primary) !important;
        color: #ffffff !important;
        box-shadow: 0 6px 15px rgba(129, 196, 8, 0.2);
    }
    .form-control:focus {
        border-color: var(--nesa-primary) !important;
        box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.15) !important;
    }
    .btn-nesa-submit {
        background-color: var(--nesa-primary);
        color: #ffffff;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-nesa-submit:hover {
        background-color: var(--nesa-primary-hover);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(129, 196, 8, 0.3);
    }
</style>

<!-- Page Header Start -->
<div class="container-fluid contact-header text-center mb-5">
    <div class="contact-header-content" data-aos="fade-down">
        <span class="badge-premium mb-3 bg-white text-dark">HUBUNGI KAMI</span>
        <h1 class="text-white display-4 fw-bold text-glow mb-3">Hubungi NesaFood</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-white">Hubungi Kami</li>
        </ol>
    </div>
</div>
<!-- Page Header End -->

<!-- Contact Form Section Start -->
<div class="container py-5">
    <div class="container">
        <div class="p-5 bg-white shadow-sm rounded-4 border border-light" data-aos="fade-up">
            <div class="row g-5">
                
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <span class="badge-premium mb-2">⚡ KIRIM PESAN</span>
                    <h3 class="fw-bold text-dark mb-3">Hubungi Tim Layanan Kami</h3>
                    <p class="text-muted mb-4 leading-relaxed">Punya pertanyaan, saran, atau kendala mengenai pemesanan? Jangan ragu untuk mengirimkan pesan kepada tim kami. Kami siap membantu Anda!</p>
                    
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-radius: 12px;">
                            <i class="fas fa-check-circle me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control py-3 border-light bg-light" style="border-radius:12px;" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-semibold">Alamat Email</label>
                                <input type="email" name="email" class="form-control py-3 border-light bg-light" style="border-radius:12px;" placeholder="Masukkan email Anda" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark fw-semibold">Isi Pesan</label>
                                <textarea name="message" class="form-control border-light bg-light" style="border-radius:12px;" rows="6" placeholder="Tuliskan detail pertanyaan atau saran Anda..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-nesa-submit w-100 py-3 text-uppercase font-bold text-white shadow-sm" type="submit">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Info Cards -->
                <div class="col-lg-5">
                    <span class="badge-premium mb-2" style="background: rgba(255, 140, 0, 0.1); color: var(--nesa-accent); border-color: rgba(255, 140, 0, 0.2);">ℹ️ LAYANAN</span>
                    <h3 class="fw-bold text-dark mb-4">Informasi Kontak</h3>
                    
                    <!-- Address -->
                    <div class="d-flex p-4 rounded-3 mb-4 bg-light border border-light info-card">
                        <div class="icon-circle bg-white text-primary me-3 flex-shrink-0" style="width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Lokasi Kami</h5>
                            <p class="text-muted mb-0 small leading-relaxed">Kantin Gedung C, Kampus UNESA Ketintang, Gayungan, Surabaya</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="d-flex p-4 rounded-3 mb-4 bg-light border border-light info-card">
                        <div class="icon-circle bg-white text-primary me-3 flex-shrink-0" style="width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Email Layanan</h5>
                            <p class="text-muted mb-0 small leading-relaxed">support@nesafood.com</p>
                            <p class="text-muted mb-0 small leading-relaxed">info@nesafood.com</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="d-flex p-4 rounded-3 mb-4 bg-light border border-light info-card">
                        <div class="icon-circle bg-white text-primary me-3 flex-shrink-0" style="width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Hubungi Telepon</h5>
                            <p class="text-muted mb-0 small leading-relaxed">+62 8999 2343 11</p>
                            <p class="text-muted mb-0 small leading-relaxed">(031) 8299123</p>
                        </div>
                    </div>

                    <!-- Clock -->
                    <div class="d-flex p-4 rounded-3 bg-light border border-light info-card">
                        <div class="icon-circle bg-white text-primary me-3 flex-shrink-0" style="width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Jam Operasional</h5>
                            <p class="text-muted mb-0 small leading-relaxed">Senin - Jumat: 08:00 - 16:00 WIB</p>
                            <p class="text-muted mb-0 small leading-relaxed">Sabtu - Minggu: Tutup (Kantin Libur)</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Contact Form Section End -->

@endsection
