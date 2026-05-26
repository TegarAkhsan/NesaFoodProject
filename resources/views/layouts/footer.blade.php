<!-- Footer Start -->
<style>
    .nesa-footer {
        background-color: #0f241a !important;
        color: rgba(255, 255, 255, 0.6) !important;
        font-family: 'Open Sans', sans-serif;
    }

    .nesa-footer h1, .nesa-footer h4 {
        color: #ffffff !important;
        font-weight: 700;
    }

    .nesa-footer .border-accent {
        border-bottom: 1px solid rgba(129, 196, 8, 0.15) !important;
    }

    .nesa-footer .footer-title {
        font-size: 1.15rem;
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .nesa-footer .footer-title::after {
        content: '';
        position: absolute;
        width: 35px;
        height: 3px;
        background-color: #81c408;
        bottom: 0;
        left: 0;
        border-radius: 99px;
    }

    .nesa-footer .footer-link {
        display: block;
        color: rgba(255, 255, 255, 0.7) !important;
        text-decoration: none !important;
        transition: all 0.25s ease;
        margin-bottom: 12px;
        font-size: 0.92rem;
        width: fit-content;
    }

    .nesa-footer .footer-link:hover {
        color: #81c408 !important;
        transform: translateX(6px);
    }

    .nesa-footer .footer-link i {
        font-size: 0.8rem;
        opacity: 0;
        transition: all 0.25s ease;
        margin-right: 0;
    }

    .nesa-footer .footer-link:hover i {
        opacity: 1;
        margin-right: 6px;
    }

    .nesa-footer .social-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.05);
        color: #ffffff !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-decoration: none !important;
    }

    .nesa-footer .social-icon:hover {
        background-color: #81c408;
        color: #ffffff !important;
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(129, 196, 8, 0.3);
        border-color: #81c408;
    }

    .nesa-footer .btn-subscribe {
        background-color: #81c408;
        color: #ffffff;
        font-weight: 700;
        border-radius: 99px;
        padding: 10px 24px;
        transition: all 0.3s ease;
        border: none;
    }

    .nesa-footer .btn-subscribe:hover {
        background-color: #6ea406;
        box-shadow: 0 6px 15px rgba(129, 196, 8, 0.35);
    }

    .nesa-footer .input-subscribe {
        background-color: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
        border-radius: 99px;
        padding-left: 20px;
    }

    .nesa-footer .input-subscribe::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .nesa-footer .input-subscribe:focus {
        border-color: #81c408 !important;
        box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.25) !important;
    }

    .nesa-footer .btn-readmore {
        border: 2px solid #81c408 !important;
        color: #ffffff !important;
        font-weight: 700;
        padding: 8px 24px;
        border-radius: 99px;
        transition: all 0.3s ease;
        background: transparent;
        text-decoration: none !important;
        display: inline-block;
    }

    .nesa-footer .btn-readmore:hover {
        background-color: #81c408;
        color: #ffffff !important;
        box-shadow: 0 6px 15px rgba(129, 196, 8, 0.25);
    }

    .nesa-copyright {
        background-color: #0b1a13 !important;
        border-top: 1px solid rgba(255,255,255,0.03);
    }
</style>

<div class="container-fluid nesa-footer text-white-50 pt-5 mt-5">
    <div class="container py-5">
        <!-- Top row: Brand & Newsletter & Socials -->
        <div class="pb-4 mb-5 border-accent">
            <div class="row g-4 align-items-center">
                <!-- Brand Info -->
                <div class="col-lg-3">
                    <a href="#" class="text-decoration-none">
                        <h1 class="text-primary mb-1" style="font-size: 2.2rem;">NesaFood</h1>
                        <p class="mb-0 text-uppercase tracking-wider" style="color: #ff8c00; font-size: 0.75rem; font-weight: 700;">Food Court UNESA</p>
                    </a>
                </div>
                <!-- Newsletter -->
                <div class="col-lg-6">
                    <form onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');" class="position-relative mx-auto">
                        <input class="form-control input-subscribe w-100 py-3 px-4" type="email" placeholder="Masukkan alamat email Anda" required>
                        <button type="submit" class="btn-subscribe py-2 px-4 position-absolute text-white" style="top: 5px; right: 5px;">Langganan</button>
                    </form>
                </div>
                <!-- Social Media -->
                <div class="col-lg-3 text-lg-end">
                    <div class="d-inline-flex">
                        <a class="social-icon" href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="social-icon" href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a class="social-icon" href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle row: 4 Columns -->
        <div class="row g-5">
            <!-- Col 1: About -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-title">Mengapa Memilih Kami?</h4>
                <p class="mb-4" style="font-size: 0.92rem; line-height: 1.6;">NesaFood mempermudah akses ke Food Court UNESA dengan pemesanan yang cepat, pilihan variasi beragam, serta pengalaman kuliner praktis dan efisien.</p>
                <a href="{{ url('/aboutus') }}" class="btn-readmore">Selengkapnya</a>
            </div>
            
            <!-- Col 2: Info -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-title">Informasi Nesa</h4>
                <div class="d-flex flex-column text-start">
                    <a href="{{ route('aboutus') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Hubungi Kami</a>
                    <a href="{{ route('terms') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Syarat & Ketentuan</a>
                    <a href="{{ route('faq') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Bantuan & FAQ</a>
                </div>
            </div>

            <!-- Col 3: Account -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-title">Akun Pengguna</h4>
                <div class="d-flex flex-column text-start">
                    <a href="{{ route('user.dashboard') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Dashboard Saya</a>
                    <a href="{{ url('/cart') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Keranjang Belanja</a>
                    <a href="{{ route('order') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Riwayat Transaksi</a>
                    <a href="{{ url('/auth/login') }}" class="footer-link"><i class="fas fa-chevron-right"></i> Login Pemilik Stand</a>
                </div>
            </div>

            <!-- Col 4: Contact -->
            <div class="col-lg-3 col-md-6">
                <h4 class="footer-title">Kontak Hubungi</h4>
                <div style="font-size: 0.92rem; line-height: 1.8;">
                    <p class="mb-3"><i class="fas fa-map-marker-alt text-primary me-3" style="font-size: 1.1rem;"></i> Kampus UNESA Ketintang, Gayungan, Surabaya</p>
                    <p class="mb-3"><i class="fas fa-envelope text-primary me-3" style="font-size: 1.1rem;"></i> support@nesafood.com</p>
                    <p class="mb-3"><i class="fas fa-phone-alt text-primary me-3" style="font-size: 1.1rem;"></i> +62 8999 2343 11</p>
                    <p class="mb-0"><i class="fas fa-clock text-primary me-3" style="font-size: 1.1rem;"></i> Senin - Jumat: 08:00 - 16:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid nesa-copyright py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-white-50" style="font-size: 0.9rem;">
                    <i class="far fa-copyright me-2"></i> {{ date('Y') }} <a href="#" class="text-primary text-decoration-none fw-bold">NesaFood UNESA</a>. Hak Cipta Dilindungi Undang-Undang.
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end text-white-50" style="font-size: 0.9rem;">
                <span>Dibuat dengan <i class="fas fa-heart text-danger mx-1"></i> untuk Kebahagiaan Kuliner Anda</span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
