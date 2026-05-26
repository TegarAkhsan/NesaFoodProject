@extends('layouts.app')
@section('title', 'NesaFood - Bantuan & FAQ')
@section('content')

<style>
    .faq-header {
        background: linear-gradient(135deg, rgba(27, 67, 50, 0.9) 0%, rgba(15, 36, 26, 0.95) 100%), url("{{ asset('img/cart-page-header-img.jpg') }}");
        background-position: center;
        background-size: cover;
        padding: 120px 0 80px 0;
        margin-top: 90px;
        position: relative;
        overflow: hidden;
    }
    .faq-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 24px;
        background: #ffffff;
        clip-path: ellipse(60% 100% at 50% 100%);
    }
    .faq-header-content {
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
    .accordion-button:not(.collapsed) {
        background-color: var(--nesa-primary-light);
        color: var(--nesa-primary-hover);
        box-shadow: none;
    }
    .accordion-button:focus {
        border-color: var(--nesa-primary);
        box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.2);
    }
    .accordion-item {
        border-radius: 16px !important;
        overflow: hidden;
        border: 1px solid #edf2f7 !important;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.01);
        transition: all 0.3s ease;
    }
    .accordion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(27, 67, 50, 0.04);
        border-color: rgba(129, 196, 8, 0.15) !important;
    }
    .btn-nesa-faq {
        background-color: var(--nesa-primary);
        color: #ffffff;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 12px 30px;
        border: none;
    }
    .btn-nesa-faq:hover {
        background-color: var(--nesa-primary-hover);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(129, 196, 8, 0.3);
    }
</style>

<!-- Page Header Start -->
<div class="container-fluid faq-header text-center mb-5">
    <div class="faq-header-content" data-aos="fade-down">
        <span class="badge-premium mb-3 bg-white text-dark">PUSAT BANTUAN</span>
        <h1 class="text-white display-4 fw-bold text-glow mb-3">Bantuan & FAQ</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-white">Bantuan & FAQ</li>
        </ol>
    </div>
</div>
<!-- Page Header End -->

<!-- FAQ Content Section Start -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 bg-white p-5 shadow-sm rounded-4 border border-light" data-aos="fade-up">
            <h2 class="fw-bold text-dark mb-2 text-center">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-muted text-center mb-5">Cari tahu jawaban dari berbagai pertanyaan umum seputar penggunaan platform NesaFood.</p>

            <div class="accordion" id="accordionFAQ">
                
                <!-- FAQ 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="far fa-question-circle text-primary me-2"></i> Bagaimana cara memesan makanan di NesaFood?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-muted leading-relaxed">
                            Pemesanan sangat mudah! Ikuti langkah cepat ini:
                            <ol class="mt-2 mb-0">
                                <li>Masuk ke akun Anda (Register/Login).</li>
                                <li>Pilih menu makanan atau minuman favorit Anda di halaman utama.</li>
                                <li>Klik <strong>"Beli"</strong> untuk memasukkan ke keranjang belanja.</li>
                                <li>Buka keranjang belanja Anda di pojok kanan atas, periksa pesanan Anda, lalu isi catatan kelas/lokasi pengantaran.</li>
                                <li>Pilih metode pembayaran dan lakukan <strong>Checkout</strong>. Pesanan Anda akan langsung diproses oleh pihak stand!</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="far fa-question-circle text-primary me-2"></i> Apakah NesaFood mendukung pembayaran nontunai?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-muted leading-relaxed">
                            Ya, tentu saja! NesaFood sangat mendukung transaksi modern yang praktis. Kami menyediakan metode pembayaran nontunai (*cashless*) terintegrasi via **QRIS**, berbagai **E-Wallet** (GoPay, OVO, Dana), maupun potong **Saldo NesaFood** secara instan. Kami juga tetap menyediakan opsi pembayaran Tunai (COD) di lokasi.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="far fa-question-circle text-primary me-2"></i> Bagaimana jika makanan yang saya pesan habis di stand?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-muted leading-relaxed">
                            Kenyamanan Anda adalah prioritas kami. Jika stok suatu menu habis setelah Anda membayar, pihak pemilik stand akan segera menghubungi Anda melalui nomor kontak terdaftar untuk menawarkan alternatif menu lain atau melakukan **pembatalan**. Jika pesanan dibatalkan, pembayaran nontunai Anda akan dikembalikan **100% utuh tanpa potongan**.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <i class="far fa-question-circle text-primary me-2"></i> Di mana area cakupan pengantaran NesaFood?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-muted leading-relaxed">
                            Saat ini, NesaFood khusus melayani wilayah internal **Kampus UNESA Ketintang, Surabaya**. Kami mengantarkan makanan ke seluruh area gedung perkuliahan, laboratorium, perpustakaan, kantor dosen, hingga area publik dalam kampus secara gratis atau dengan ongkir sangat minim.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <i class="far fa-question-circle text-primary me-2"></i> Bagaimana cara mendaftarkan stand makanan saya di NesaFood?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body text-muted leading-relaxed">
                            Bagi para pemilik tenant kantin UNESA yang berminat bermitra, Anda dapat mendaftar dengan menghubungi Administrator NesaFood di kantor pengelola foodcourt atau mengirimkan pengajuan kerja sama melalui halaman **Hubungi Kami**. Setelah pendaftaran disetujui, Anda akan mendapatkan akun kredensial untuk mengakses Dashboard Stand Owner.
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="mt-5 text-center">
                <p class="text-muted">Masih memiliki pertanyaan lain yang belum terjawab?</p>
                <a href="{{ url('/contact') }}" class="btn btn-nesa-faq px-4 py-3 text-white font-bold">
                    <i class="fas fa-question me-2"></i> Tanyakan Pada Kami
                </a>
            </div>
        </div>
    </div>
</div>
<!-- FAQ Content Section End -->

@endsection
