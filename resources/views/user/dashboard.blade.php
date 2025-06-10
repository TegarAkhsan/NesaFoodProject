@extends('layouts.app')
@section('title', 'User Dashboard')

@section('content')
<div class="container" style="margin-top: 150px; padding-left: 20px; padding-right: 20px;">
    <div class="row g-4">

        <!-- Sidebar Profile -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" 
                        alt="Avatar" class="rounded-circle mb-3" width="100" height="100">
                    <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">Edit Profil</a>
                </div>
            </div>

            <div class="card mt-4 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-secondary">Akun</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('order') }}" class="text-decoration-none d-block py-1">📦 Riwayat Pemesanan</a></li>
                        <li><a href="#" class="text-decoration-none d-block py-1">❤️ Favorit</a></li>
                        <li><a href="#" class="text-decoration-none d-block py-1">🎟️ Promo Saya</a></li>
                        <li><a href="#" class="text-decoration-none d-block py-1">⚙️ Preferensi</a></li>
                        <li>
                            <a href="{{ route('auth.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="text-decoration-none d-block py-1 text-danger">🚪 Logout</a>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">📋 Ringkasan Akun</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="bg-light rounded p-3 h-100">
                                <h6 class="text-muted">Total Pemesanan</h6>
                                <h3 class="text-primary fw-bold">12</h3>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="bg-light rounded p-3 h-100">
                                <h6 class="text-muted">Pesanan Aktif</h6>
                                <h3 class="text-warning fw-bold">2</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pemesanan Terakhir -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">📦 Pemesanan Terbaru</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contoh data, sesuaikan dengan variabel dari controller -->
                                <tr>
                                    <td>INV-0012</td>
                                    <td>Ayam Bakar + Es Teh</td>
                                    <td>10 Juni 2025</td>
                                    <td>Rp 28.000</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>INV-0013</td>
                                    <td>Nasi Goreng Spesial</td>
                                    <td>11 Juni 2025</td>
                                    <td>Rp 22.000</td>
                                    <td><span class="badge bg-warning text-dark">Diproses</span></td>
                                </tr>
                                <!-- End contoh -->
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('order') }}" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <!-- Promo Aktif -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">🎁 Promo Aktif</h4>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Kode: GEPREK20 - Diskon 20% Ayam Geprek
                            <span class="badge bg-primary">Aktif</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Kode: NASGOR15 - Diskon 15% Nasi Goreng
                            <span class="badge bg-primary">Aktif</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
