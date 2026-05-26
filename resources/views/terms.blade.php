@extends('layouts.app')
@section('title', 'NesaFood - Syarat & Ketentuan')
@section('content')

<style>
    .terms-header {
        background: linear-gradient(135deg, rgba(27, 67, 50, 0.9) 0%, rgba(15, 36, 26, 0.95) 100%), url("{{ asset('img/cart-page-header-img.jpg') }}");
        background-position: center;
        background-size: cover;
        padding: 120px 0 80px 0;
        margin-top: 90px;
        position: relative;
        overflow: hidden;
    }
    .terms-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 24px;
        background: #ffffff;
        clip-path: ellipse(60% 100% at 50% 100%);
    }
    .terms-header-content {
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
    .terms-content h5 {
        color: var(--nesa-dark);
        font-weight: 700;
        margin-top: 30px;
        margin-bottom: 15px;
        position: relative;
        padding-left: 15px;
    }
    .terms-content h5::before {
        content: '';
        position: absolute;
        left: 0;
        top: 4px;
        bottom: 4px;
        width: 4px;
        background: var(--nesa-primary);
        border-radius: 2px;
    }
    .terms-content p, .terms-content li {
        color: #4a5568;
        line-height: 1.8;
    }
    .terms-content li {
        margin-bottom: 10px;
    }
</style>

<!-- Page Header Start -->
<div class="container-fluid terms-header text-center mb-5">
    <div class="terms-header-content" data-aos="fade-down">
        <span class="badge-premium mb-3 bg-white text-dark">KEBIJAKAN LAYANAN</span>
        <h1 class="text-white display-4 fw-bold text-glow mb-3">Syarat & Ketentuan</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-white">Syarat & Ketentuan</li>
        </ol>
    </div>
</div>
<!-- Page Header End -->

<!-- Terms Content Section Start -->
<div class="container py-5 terms-content">
    <div class="row justify-content-center">
        <div class="col-lg-10 bg-white p-5 shadow-sm rounded-4 border border-light" data-aos="fade-up">
            <h2 class="fw-bold text-dark mb-2 text-center">Ketentuan Penggunaan NesaFood</h2>
            <p class="text-muted text-center mb-5">Terakhir diperbarui: Mei 2026</p>

            <p class="lead text-muted">Selamat datang di <strong>NesaFood</strong>. Harap membaca Syarat & Ketentuan ini secara seksama sebelum Anda mulai memesan makanan melalui sistem kami. Dengan mengakses dan menggunakan platform NesaFood, Anda menyetujui untuk terikat oleh ketentuan-ketentuan di bawah ini.</p>

            <hr class="my-5" style="opacity: 0.1;">

            <h5>1. Ketentuan Umum Layanan</h5>
            <ul>
                <li>NesaFood adalah platform digital pemesanan makanan khusus untuk civitas akademika Universitas Negeri Surabaya (UNESA) Ketintang.</li>
                <li>Layanan kami hanya memfasilitasi transaksi pemesanan antara pembeli dan pemilik stand terdaftar di area Food Court UNESA.</li>
                <li>Pengguna setuju untuk memberikan data profil dan alamat pengantaran kelas/lokasi secara akurat demi kelancaran pengantaran.</li>
            </ul>

            <h5>2. Akun Pengguna & Keamanan</h5>
            <ul>
                <li>Anda wajib menjaga keamanan kata sandi akun NesaFood Anda secara mandiri.</li>
                <li>Setiap aktivitas pemesanan yang dilakukan melalui akun Anda sepenuhnya menjadi tanggung jawab Anda sendiri.</li>
                <li>NesaFood berhak menangguhkan akun secara sepihak jika terdeteksi penyalahgunaan sistem atau kecurangan.</li>
            </ul>

            <h5>3. Ketentuan Pemesanan & Harga</h5>
            <ul>
                <li>Semua harga menu makanan dan minuman ditentukan langsung oleh masing-masing pemilik stand dan dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</li>
                <li>Pemesanan hanya akan diproses setelah pengguna berhasil melakukan checkout dan pembayaran dikonfirmasi.</li>
                <li>Jika terdapat ketidaktersediaan stok menu di stand, pemilik stand wajib mengonfirmasi pembatalan kepada pembeli, dan pembayaran cashless akan dikembalikan secara penuh.</li>
            </ul>

            <h5>4. Sistem Pembayaran & Pembatalan</h5>
            <ul>
                <li>NesaFood mendukung opsi pembayaran cashless terintegrasi (QRIS/E-Wallet/Potongan Saldo) serta pembayaran Tunai (COD) saat pengantaran.</li>
                <li>Pesanan yang sudah diproses oleh pihak stand **tidak dapat dibatalkan** secara sepihak oleh pembeli.</li>
                <li>Jika terdapat perselisihan transaksi, pembeli dapat menghubungi Tim Layanan Pelanggan NesaFood melalui halaman Hubungi Kami.</li>
            </ul>

            <h5>5. Batasan Tanggung Jawab</h5>
            <ul>
                <li>NesaFood tidak bertanggung jawab atas kualitas rasa, kebersihan, porsi, maupun alergi makanan yang timbul. Hal tersebut sepenuhnya merupakan tanggung jawab stand kuliner yang bersangkutan.</li>
                <li>Keterlambatan pengantaran yang disebabkan oleh faktor eksternal (cuaca, keramaian antrean stand) akan diinformasikan oleh pengantar secara proaktif.</li>
            </ul>

            <div class="mt-5 pt-4 border-top text-center text-muted small">
                <p class="mb-0">Terima kasih telah mempercayakan kebahagiaan kuliner Anda bersama NesaFood UNESA!</p>
            </div>
        </div>
    </div>
</div>
<!-- Terms Content Section End -->

@endsection
