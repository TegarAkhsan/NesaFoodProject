@extends('layouts.app')
@section('title', 'User Dashboard')

@section('content')
<style>
    :root {
        --nesa-primary: #81c408;
        --nesa-primary-light: rgba(129, 196, 8, 0.1);
        --nesa-primary-hover: #6ea406;
        --nesa-dark: #1b4332;
        --nesa-light: #f8fbf8;
        --nesa-accent: #ff8c00;
        --nesa-accent-light: rgba(255, 140, 0, 0.1);
        --nesa-card-shadow: 0 10px 30px rgba(27, 67, 50, 0.04);
        --nesa-card-hover: 0 16px 40px rgba(27, 67, 50, 0.08);
        --nesa-border-radius: 18px;
    }

    body {
        background-color: #f7faf7 !important;
        font-family: 'Open Sans', sans-serif;
    }

    .premium-card {
        border: none !important;
        border-radius: var(--nesa-border-radius);
        box-shadow: var(--nesa-card-shadow);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        overflow: hidden;
    }

    .premium-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--nesa-card-hover);
    }

    .avatar-ring {
        position: relative;
        display: inline-block;
        padding: 5px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--nesa-primary), var(--nesa-accent));
        box-shadow: 0 8px 20px rgba(129, 196, 8, 0.2);
    }

    .avatar-img {
        border: 4px solid #ffffff;
        transition: all 0.3s ease;
    }

    .avatar-ring:hover .avatar-img {
        transform: scale(1.05);
    }

    .profile-card {
        background: linear-gradient(180deg, #ffffff 0%, #fcfdfc 100%);
    }

    .sidebar-menu-link {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        color: #4a5568;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.25s ease;
        border-left: 4px solid transparent;
        margin-bottom: 8px;
        text-decoration: none !important;
        cursor: pointer;
    }

    .sidebar-menu-link i {
        font-size: 1.1rem;
        transition: all 0.25s ease;
        width: 24px;
        text-align: center;
    }

    .sidebar-menu-link:hover {
        background-color: var(--nesa-primary-light);
        color: var(--nesa-primary-hover);
        border-left-color: var(--nesa-primary);
        padding-left: 22px;
    }

    .sidebar-menu-link:hover i {
        transform: translateX(3px);
    }

    .sidebar-menu-link.active {
        background-color: var(--nesa-primary-light);
        color: var(--nesa-primary-hover);
        border-left-color: var(--nesa-primary);
    }

    .sidebar-menu-link.danger-link:hover {
        background-color: rgba(239, 68, 68, 0.08);
        color: #dc2626;
        border-left-color: #ef4444;
    }

    .summary-card {
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.02) !important;
        position: relative;
        overflow: hidden;
    }

    .summary-card::after {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
        top: -50px;
        right: -50px;
        opacity: 0.6;
        pointer-events: none;
    }

    .summary-card-primary {
        background: linear-gradient(135deg, #f8fbf4 0%, #edf7e2 100%);
        border-left: 6px solid var(--nesa-primary) !important;
    }

    .summary-card-warning {
        background: linear-gradient(135deg, #fffbf2 0%, #fff4e5 100%);
        border-left: 6px solid var(--nesa-accent) !important;
    }

    .icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        box-shadow: 0 6px 15px rgba(0,0,0,0.03);
    }

    .icon-circle-primary {
        background-color: #ffffff;
        color: var(--nesa-primary-hover);
    }

    .icon-circle-warning {
        background-color: #ffffff;
        color: var(--nesa-accent);
    }

    .custom-table th {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #718096;
        border-bottom: 2px solid #edf2f7;
        padding: 15px 20px;
    }

    .custom-table td {
        padding: 18px 20px;
        font-size: 0.92rem;
        color: #2d3748;
        border-bottom: 1px solid #edf2f7;
    }

    .custom-table tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tr:hover {
        background-color: #fafdfa;
    }

    .badge-status {
        padding: 6px 14px;
        font-size: 0.78rem;
        font-weight: 700;
        border-radius: 99px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-status-completed {
        background-color: #def7ec;
        color: #03543f;
    }

    .badge-status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-status-completed::before {
        content: '';
        width: 6px;
        height: 6px;
        background-color: #31c48d;
        border-radius: 50%;
    }

    .badge-status-pending::before {
        content: '';
        width: 6px;
        height: 6px;
        background-color: #f59e0b;
        border-radius: 50%;
    }

    .promo-ticket {
        background: radial-gradient(circle at left, transparent 10px, #ffffff 10px) right,
                    radial-gradient(circle at right, transparent 10px, #ffffff 10px) left;
        background-size: 51% 100%;
        background-repeat: no-repeat;
        border: 1px dashed #e2e8f0;
        border-radius: 12px;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }

    .promo-ticket:hover {
        border-color: var(--nesa-primary);
        box-shadow: 0 8px 25px rgba(129, 196, 8, 0.08);
        transform: scale(1.01);
    }

    .btn-nesa {
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 700;
        font-size: 0.88rem;
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

    /* Tab Content CSS Transitions */
    .tab-content {
        transition: opacity 0.3s ease;
        opacity: 1;
    }

    /* Favorite Food Design */
    .fav-item-card {
        border: 1px solid #f0f4f0;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .fav-item-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(27, 67, 50, 0.06);
        border-color: var(--nesa-primary-light);
    }

    /* Form Design */
    .form-control-nesa, .form-select-nesa {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        transition: all 0.25s ease;
    }

    .form-control-nesa:focus, .form-select-nesa:focus {
        border-color: var(--nesa-primary);
        box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.2);
        outline: none;
    }
</style>

<div class="container" style="margin-top: 130px; margin-bottom: 60px; padding-left: 20px; padding-right: 20px;">
    <div class="row g-4">

        <!-- Sidebar Profile & Nav -->
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card premium-card profile-card text-center py-4 px-3 mb-4">
                <div class="card-body">
                    <div class="avatar-ring mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=81c408&color=fff" 
                            alt="Avatar" class="avatar-img rounded-circle" width="96" height="96">
                    </div>
                    <h4 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-3 font-semibold" style="font-size: 0.9rem;">
                        <i class="far fa-envelope me-1"></i> {{ Auth::user()->email }}
                    </p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-nesa btn-nesa-outline w-100">
                        <i class="fas fa-user-edit me-2"></i> Edit Profil
                    </a>
                </div>
            </div>

            <!-- Sidebar Navigation -->
            <div class="card premium-card p-3">
                <div class="card-body p-1">
                    <p class="text-xs font-bold text-muted uppercase tracking-wider mb-3 px-3">📂 Navigasi Akun</p>
                    <div class="d-flex flex-column">
                        <a onclick="switchTab('tab-riwayat', this)" class="sidebar-menu-link active">
                            <i class="fas fa-box me-3 text-primary"></i> Riwayat Pemesanan
                        </a>
                        <a onclick="switchTab('tab-favorit', this)" class="sidebar-menu-link">
                            <i class="fas fa-heart me-3 text-danger"></i> Makanan Favorit
                        </a>
                        <a onclick="switchTab('tab-promo', this)" class="sidebar-menu-link">
                            <i class="fas fa-ticket-alt me-3 text-warning"></i> Promo Saya
                        </a>
                        <a onclick="switchTab('tab-preferensi', this)" class="sidebar-menu-link">
                            <i class="fas fa-cog me-3 text-secondary"></i> Preferensi Akun
                        </a>
                        <a href="{{ route('auth.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="sidebar-menu-link danger-link">
                            <i class="fas fa-sign-out-alt me-3 text-danger"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">

            <!-- ======================================= -->
            <!-- TAB 1: RIWAYAT PEMESANAN (DEFAULT TAB)  -->
            <!-- ======================================= -->
            <div id="tab-riwayat" class="tab-content">
                <!-- Account Summary Section -->
                <div class="card premium-card mb-4 p-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                            <span class="icon-circle icon-circle-primary me-3" style="width:36px; height:36px; font-size:1rem;"><i class="fas fa-chart-pie"></i></span>
                            Ringkasan Aktivitas Anda
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="summary-card summary-card-primary d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-1" style="font-size: 0.85rem; font-weight:600;">Total Pemesanan</h6>
                                        <h2 class="fw-bold mb-0 text-dark" style="font-size: 2.2rem;">12</h2>
                                    </div>
                                    <div class="icon-circle icon-circle-primary">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="summary-card summary-card-warning d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="text-muted mb-1" style="font-size: 0.85rem; font-weight:600;">Pesanan Aktif</h6>
                                        <h2 class="fw-bold mb-0 text-dark" style="font-size: 2.2rem;">2</h2>
                                    </div>
                                    <div class="icon-circle icon-circle-warning">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Section -->
                <div class="card premium-card mb-4 p-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold text-dark mb-0 d-flex align-items-center">
                                <span class="icon-circle icon-circle-primary me-3" style="width:36px; height:36px; font-size:1rem;"><i class="fas fa-receipt"></i></span>
                                Pemesanan Terbaru
                            </h5>
                            <a href="{{ route('order') }}" class="btn btn-sm btn-nesa btn-nesa-outline">
                                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table custom-table align-middle">
                                <thead>
                                    <tr>
                                        <th># Invoice</th>
                                        <th>Menu</th>
                                        <th>Tanggal</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-primary">INV-0012</td>
                                        <td>
                                            <div class="fw-bold">Ayam Bakar + Es Teh</div>
                                            <span class="text-muted" style="font-size: 0.8rem;">Dapur Nusantara</span>
                                        </td>
                                        <td class="text-muted">10 Juni 2025</td>
                                        <td class="fw-bold text-dark">Rp 28.000</td>
                                        <td><span class="badge-status badge-status-completed">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-primary">INV-0013</td>
                                        <td>
                                            <div class="fw-bold">Nasi Goreng Spesial</div>
                                            <span class="text-muted" style="font-size: 0.8rem;">Warung Laris</span>
                                        </td>
                                        <td class="text-muted">11 Juni 2025</td>
                                        <td class="fw-bold text-dark">Rp 22.000</td>
                                        <td><span class="badge-status badge-status-pending">Diproses</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================================= -->
            <!-- TAB 2: MAKANAN FAVORIT                  -->
            <!-- ======================================= -->
            <div id="tab-favorit" class="tab-content d-none" style="opacity: 0;">
                <div class="card premium-card p-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                            <span class="icon-circle icon-circle-primary me-3" style="width:36px; height:36px; font-size:1rem;"><i class="fas fa-heart text-danger"></i></span>
                            Makanan Favorit Anda
                        </h5>
                        <p class="text-muted mb-4" style="font-size: 0.9rem;">Daftar menu makanan favorit yang sering Anda pesan. Klik 'Pesan Lagi' untuk menambahkannya langsung ke keranjang Anda.</p>
                        
                        <div class="row g-3">
                            <!-- Fav 1 -->
                            <div class="col-md-6">
                                <div class="fav-item-card p-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon-circle bg-light text-3xl" style="width:55px; height:55px; border-radius:12px;">🍗</div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">Ayam Geprek Mozzarella</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Stand Ayam Geprek</p>
                                            <span class="fw-bold text-success" style="font-size: 0.9rem;">Rp 18.000</span>
                                        </div>
                                    </div>
                                    <button onclick="addFavToCart('Ayam Geprek Mozzarella', 18000, 'default-food.jpg', this)" class="btn btn-sm btn-nesa btn-nesa-primary py-2 px-3">
                                        <i class="fas fa-cart-plus me-1"></i> Pesan Lagi
                                    </button>
                                </div>
                            </div>
                            <!-- Fav 2 -->
                            <div class="col-md-6">
                                <div class="fav-item-card p-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon-circle bg-light text-3xl" style="width:55px; height:55px; border-radius:12px;">🍳</div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">Nasi Goreng Spesial</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Warung Laris</p>
                                            <span class="fw-bold text-success" style="font-size: 0.9rem;">Rp 22.000</span>
                                        </div>
                                    </div>
                                    <button onclick="addFavToCart('Nasi Goreng Spesial', 22000, 'default-food.jpg', this)" class="btn btn-sm btn-nesa btn-nesa-primary py-2 px-3">
                                        <i class="fas fa-cart-plus me-1"></i> Pesan Lagi
                                    </button>
                                </div>
                            </div>
                            <!-- Fav 3 -->
                            <div class="col-md-6">
                                <div class="fav-item-card p-3 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="icon-circle bg-light text-3xl" style="width:55px; height:55px; border-radius:12px;">🥤</div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">Es Teh Manis Selasih</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.8rem;">Stand Minuman Segar</p>
                                            <span class="fw-bold text-success" style="font-size: 0.9rem;">Rp 5.000</span>
                                        </div>
                                    </div>
                                    <button onclick="addFavToCart('Es Teh Manis Selasih', 5000, 'default-food.jpg', this)" class="btn btn-sm btn-nesa btn-nesa-primary py-2 px-3">
                                        <i class="fas fa-cart-plus me-1"></i> Pesan Lagi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================================= -->
            <!-- TAB 3: PROMO SAYA                       -->
            <!-- ======================================= -->
            <div id="tab-promo" class="tab-content d-none" style="opacity: 0;">
                <div class="card premium-card p-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                            <span class="icon-circle icon-circle-primary me-3" style="width:36px; height:36px; font-size:1rem;"><i class="fas fa-ticket-alt text-warning"></i></span>
                            Voucher & Promo Saya
                        </h5>
                        <p class="text-muted mb-4" style="font-size: 0.9rem;">Gunakan kode kupon di bawah ini untuk mendapatkan potongan harga spesial pada pesanan Anda berikutnya!</p>
                        
                        <div class="promo-ticket">
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-3xl">🍗</span>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Diskon 20% Ayam Geprek</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem;">Kode Kupon: <strong class="text-orange-500 font-mono">GEPREK20</strong></p>
                                </div>
                            </div>
                            <button onclick="copyPromoCode('GEPREK20', this)" class="btn btn-sm btn-light border fw-bold px-3 py-2" style="border-radius: 8px; color: var(--nesa-primary-hover)">
                                <i class="far fa-copy me-1"></i> Salin
                            </button>
                        </div>

                        <div class="promo-ticket">
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-3xl">🍚</span>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Diskon 15% Nasi Goreng</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem;">Kode Kupon: <strong class="text-orange-500 font-mono">NASGOR15</strong></p>
                                </div>
                            </div>
                            <button onclick="copyPromoCode('NASGOR15', this)" class="btn btn-sm btn-light border fw-bold px-3 py-2" style="border-radius: 8px; color: var(--nesa-primary-hover)">
                                <i class="far fa-copy me-1"></i> Salin
                            </button>
                        </div>

                        <div class="promo-ticket">
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-3xl">🛵</span>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Potongan Rp 10.000 Pengguna Baru</h6>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem;">Kode Kupon: <strong class="text-orange-500 font-mono">NESAFREE</strong></p>
                                </div>
                            </div>
                            <button onclick="copyPromoCode('NESAFREE', this)" class="btn btn-sm btn-light border fw-bold px-3 py-2" style="border-radius: 8px; color: var(--nesa-primary-hover)">
                                <i class="far fa-copy me-1"></i> Salin
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================================= -->
            <!-- TAB 4: PREFERENSI AKUN                  -->
            <!-- ======================================= -->
            <div id="tab-preferensi" class="tab-content d-none" style="opacity: 0;">
                <div class="card premium-card p-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                            <span class="icon-circle icon-circle-primary me-3" style="width:36px; height:36px; font-size:1rem;"><i class="fas fa-cog text-secondary"></i></span>
                            Preferensi & Pengaturan Akun
                        </h5>
                        <p class="text-muted mb-4" style="font-size: 0.9rem;">Kelola preferensi akun Anda untuk pengalaman berbelanja makanan yang lebih personal dan nyaman.</p>
                        
                        <form id="form-preferensi" onsubmit="savePreferences(event)">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Kategori Makanan Favorit</label>
                                    <select class="form-select form-select-nesa">
                                        <option value="semua">Semua Kuliner</option>
                                        <option value="ayam">Aneka Ayam & Geprek</option>
                                        <option value="nasi">Nasi & Mie Goreng</option>
                                        <option value="minuman">Minuman Dingin & Es</option>
                                        <option value="cemilan">Cemilan & Gorengan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Metode Pembayaran Default</label>
                                    <select class="form-select form-select-nesa">
                                        <option value="tunai">Tunai / COD</option>
                                        <option value="qris">QRIS / E-Wallet</option>
                                        <option value="saldo">Saldo NesaFood</option>
                                    </select>
                                </div>
                                
                                <div class="col-12 mt-4">
                                    <label class="form-label fw-bold text-dark mb-3"><i class="fas fa-bell me-2"></i> Pengaturan Notifikasi Pesanan</label>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" role="switch" id="notif-whatsapp" checked>
                                        <label class="form-check-label text-muted" for="notif-whatsapp">Kirim notifikasi status pesanan via WhatsApp</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" role="switch" id="notif-email" checked>
                                        <label class="form-check-label text-muted" for="notif-email">Kirim rincian invoice ke email saya</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="dark-mode">
                                        <label class="form-check-label text-muted" for="dark-mode">Aktifkan Tampilan Dark Mode (Beta)</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <label class="form-label fw-bold text-dark">Alamat Pengantaran Default (Kelas / Lokasi)</label>
                                    <input type="text" class="form-control form-control-nesa" placeholder="Contoh: Kelas XII RPL 1, Gedung C Lantai 2" value="Kelas XII RPL 1">
                                </div>

                                <div class="col-12 mt-4 pt-3 border-t">
                                    <button type="submit" class="btn btn-nesa btn-nesa-primary px-4 py-2">
                                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Scripts for tabs and helper actions -->
<script>
    // Tab switching system
    function switchTab(tabId, element) {
        // Hide all tab content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('d-none');
            content.style.opacity = 0;
        });
        
        // Show target tab content with animation
        const activeContent = document.getElementById(tabId);
        if (activeContent) {
            activeContent.classList.remove('d-none');
            setTimeout(() => {
                activeContent.style.opacity = 1;
            }, 50);
        }
        
        // Remove active class from all links
        document.querySelectorAll('.sidebar-menu-link').forEach(link => {
            link.classList.remove('active');
        });
        
        // Add active class to clicked link
        element.classList.add('active');
    }

    // Clipboard copy helper for promo codes
    function copyPromoCode(code, button) {
        navigator.clipboard.writeText(code).then(() => {
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin';
            button.style.backgroundColor = 'var(--nesa-primary-light)';
            button.style.color = 'var(--nesa-primary-hover)';
            button.style.borderColor = 'var(--nesa-primary)';
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.style.backgroundColor = '';
                button.style.color = '';
                button.style.borderColor = '';
            }, 1800);
        });
    }

    // Add to cart helper for favorite food
    function addFavToCart(name, price, image, button) {
        const originalHTML = button.innerHTML;
        
        // Pemanggilan global addToCart dari layouts/app.blade.php
        if (typeof addToCart === 'function') {
            addToCart({
                name: name,
                price: price,
                image: image
            });
            
            // Berikan feedback visual pada tombol dashboard
            button.innerHTML = '<i class="fas fa-check me-1"></i> Ditambahkan';
            button.style.backgroundColor = '#def7ec';
            button.style.color = '#03543f';
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.style.backgroundColor = '';
                button.style.color = '';
            }, 2000);
        } else {
            alert('Keranjang belanja belum siap, pastikan layout app termuat dengan benar.');
        }
    }

    // Save preferences dummy response
    function savePreferences(event) {
        event.preventDefault();
        
        // Cari tombol submit
        const form = document.getElementById('form-preferensi');
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalHTML = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
            submitBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Berhasil Disimpan!';
            submitBtn.style.backgroundColor = '#def7ec';
            submitBtn.style.color = '#03543f';
            
            setTimeout(() => {
                submitBtn.innerHTML = originalHTML;
                submitBtn.style.backgroundColor = '';
                submitBtn.style.color = '';
                submitBtn.disabled = false;
            }, 2000);
        }, 1200);
    }
</script>
@endsection
