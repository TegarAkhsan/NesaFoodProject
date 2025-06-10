@extends('layouts.app')
@section('title', 'Dashboard Stand Owner')
@section('content')
<div class="container" style="margin-top: 150px; padding-left: 20px; padding-right: 20px;">
    <h1 class="mb-4 h3 fw-bold">Dashboard - {{ $standOwner->stand_name }}</h1>

    {{-- Ringkasan --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body text-white">
                    <h5 class="card-title text-white">Jumlah Menu Aktif</h5>
                    <p class="card-text h4 text-white">{{ $standOwner->menus->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success">
                <div class="card-body text-white">
                    <h5  class="card-title text-white">Penjualan Hari Ini</h5>
                    <p class="card-text h4 text-white">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-body text-white">
                    <h5  class="card-title text-white">Pendapatan Hari Ini</h5>
                    <p class="card-text h4 text-white">Rp 200.000</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body text-white">
                    <h5  class="card-title text-white">Penjualan Bulan Ini</h5>
                    <p class="card-text h4 text-white">126</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Manajemen Menu & Order Masuk --}}
    <div class="row mb-4">
        {{-- Menu --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-semibold">Manajemen Menu</div>
                <div class="card-body">
                    <form action="{{ route('standowner.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Menu" required>
                        </div>
                        <div class="mb-2">
                            <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                        </div>
                        <div class="mb-2">
                            <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                        </div>
                        <div class="mb-2">
                            <select name="kategori" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                        </div>
                        <div class="mb-2">
                            <input type="file" name="gambar" class="form-control">
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="status" checked>
                            <label class="form-check-label">Aktif</label>
                        </div>
                        <button class="btn btn-primary">Tambah Menu</button>
                    </form>
                    <hr>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->name }}</td>
                                    <td>Rp{{ number_format($menu->price) }}</td>
                                    <td>{{ $menu->stock }}</td>
                                    <td>{{ $menu->status ? 'Aktif' : 'Nonaktif' }}</td>
                                    <td>
                                        <form action="{{ route('standowner.menu.destroy', $menu->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pesanan --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-semibold">Order Masuk</div>
                <div class="card-body">
                    @forelse ($orderItems as $item)
                        <div class="border-bottom pb-2 mb-2">
                            <strong>{{ $item->menu->name }}</strong> x {{ $item->quantity }} - Rp{{ number_format($item->subtotal) }}<br>
                            <small>Dari: {{ $item->order->name }} ({{ $item->order->address }})</small><br>
                            <span class="badge bg-secondary">{{ $item->order->status }}</span>
                            <div class="mt-2">
                                <form method="POST" action="" class="d-inline">
                                    @csrf @method('PUT')
                                    <button name="status" value="Selesai" class="btn btn-sm btn-success">Selesai</button>
                                    <button name="status" value="Dibatalkan" class="btn btn-sm btn-danger">Batalkan</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada order masuk.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Promo --}}
    <div class="card mb-4">
        <div class="card-header fw-semibold">Kelola Promo</div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="row g-2 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="kode" class="form-control" placeholder="Kode Promo">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="diskon" class="form-control" placeholder="Diskon (%)">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="berlaku_sampai" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Simpan</button>
                    </div>
                </div>
            </form>
            <table class="table table-sm">
                <thead><tr><th>Kode</th><th>Diskon</th><th>Berlaku Sampai</th></tr></thead>
                <tbody>
                        <tr>
                            <td>kode</td>
                            <td>diskon</td>
                            <td>berlaku_sampai</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Laporan Penjualan --}}
    <div class="card mb-4">
        <div class="card-header fw-semibold">Laporan Penjualan</div>
        <div class="card-body">
            <form method="GET" action="" class="row g-3 mb-3">
                <div class="col-md-4">
                    <input type="date" name="from" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <input type="date" name="to" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-outline-primary w-100">Filter</button>
                </div>
            </form>
            <p><strong>Total Pendapatan:</strong> Rp</p>
            <p><strong>Menu Terlaris:</strong> {{ $bestSeller ?? '-' }}</p>
            <a href="" class="btn btn-sm btn-success">Export PDF</a>
        </div>
    </div>

    {{-- Pengaturan Akun --}}
    <div class="card mb-5">
        <div class="card-header fw-semibold">Pengaturan Stand</div>
        <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Stand</label>
                        <input type="text" name="stand_name" class="form-control" value="{{ $standOwner->stand_name }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $standOwner->email }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Foto Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password Baru (Opsional)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-outline-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
