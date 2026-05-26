@extends('layouts.standowner')
@section('title', 'Tambah Menu Baru')
@section('content')

<style>
.so-form-page {
    display: flex;
    min-height: 100vh;
    padding-top: 0;
    background: #f4f6f9;
}

.so-form-sidebar {
    width: 240px;
    flex-shrink: 0;
    background: linear-gradient(180deg, #1b4332 0%, #0f2419 100%);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; bottom: 0; left: 0;
    z-index: 100;
    box-shadow: 4px 0 20px rgba(0,0,0,0.15);
}

.so-form-sidebar .brand { padding: 24px 20px 16px; border-bottom: 1px solid rgba(255,255,255,0.08); }
.so-form-sidebar .brand .name { font-size: 1rem; font-weight: 800; color: #fff; }
.so-form-sidebar .brand .role { font-size: 0.72rem; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.8px; }

.so-form-sidebar nav { padding: 12px 0; flex: 1; }
.so-sidebar-nav-label { font-size: 0.68rem; font-weight: 700; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1px; padding: 10px 20px 4px; }
.so-sidebar-nav-item { display: flex; align-items: center; gap: 10px; padding: 11px 20px; color: rgba(255,255,255,0.65); text-decoration: none; font-size: 0.88rem; font-weight: 600; border-left: 3px solid transparent; transition: all 0.2s; }
.so-sidebar-nav-item:hover { background: rgba(129,196,8,0.1); color: #a8d66e; border-left-color: rgba(129,196,8,0.4); }
.so-sidebar-nav-item.active { background: rgba(129,196,8,0.15); color: #81c408; border-left-color: #81c408; }
.so-sidebar-nav-item i { width: 18px; text-align: center; font-size: 1rem; }

.so-form-content { margin-left: 240px; flex: 1; padding: 28px 32px; min-height: 100vh; }

.so-form-panel { background: #fff; border-radius: 18px; box-shadow: 0 2px 16px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; overflow: hidden; max-width: 700px; }
.so-form-panel-header { padding: 20px 28px; border-bottom: 1px solid #f0f0f0; background: linear-gradient(90deg, #f0f7eb, #fff); }
.so-form-panel-header h4 { font-weight: 800; color: #1b4332; margin: 0; font-size: 1.1rem; display: flex; align-items: center; gap: 8px; }
.so-form-panel-body { padding: 28px; }

.so-label { font-size: 0.82rem; font-weight: 700; color: #555; margin-bottom: 6px; display: flex; align-items: center; gap: 5px; }
.so-input, .so-select, .so-textarea {
    width: 100%; border: 1.5px solid #e8e8e8; border-radius: 10px; padding: 11px 14px;
    font-size: 0.9rem; color: #333; background: #fafafa; outline: none;
    transition: all 0.2s; font-family: inherit; display: block;
}
.so-input:focus, .so-select:focus, .so-textarea:focus {
    border-color: #81c408; background: #fff; box-shadow: 0 0 0 3px rgba(129,196,8,0.1);
}
.so-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%231b4332' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center; background-color: #fafafa; padding-right: 36px;
}
.so-file-input {
    width: 100%; border: 2px dashed #d5edb0; border-radius: 10px; padding: 16px;
    text-align: center; background: #f9fdf4; cursor: pointer; transition: all 0.2s;
    font-size: 0.85rem; color: #888;
}
.so-file-input:hover { border-color: #81c408; background: #f0f7e6; }

.so-btn-save { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; background: linear-gradient(135deg, #81c408, #6ea406); color: #fff; border: none; border-radius: 12px; font-weight: 800; font-size: 0.95rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 16px rgba(129,196,8,0.3); text-decoration: none; }
.so-btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(129,196,8,0.45); color: #fff; }
.so-btn-back { display: inline-flex; align-items: center; gap: 7px; padding: 11px 20px; background: #fff; color: #555; border: 1.5px solid #e0e0e0; border-radius: 12px; font-weight: 700; font-size: 0.88rem; text-decoration: none; transition: all 0.2s; }
.so-btn-back:hover { border-color: #1b4332; color: #1b4332; }

.breadcrumb-so { display: flex; align-items: center; gap: 8px; font-size: 0.83rem; color: #aaa; margin-bottom: 20px; }
.breadcrumb-so a { color: #81c408; text-decoration: none; font-weight: 600; }
.breadcrumb-so a:hover { text-decoration: underline; }

.so-alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 10px; padding: 12px 16px; font-size: 0.87rem; font-weight: 600; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 8px; }
</style>

<div class="so-form-page">

    <!-- Sidebar -->
    <aside class="so-form-sidebar">
        <div class="brand">
            <div style="font-size:1.3rem;margin-bottom:6px;">🍽️</div>
            <div class="name">Stand Owner</div>
            <div class="role">Menu Management</div>
        </div>
        <nav>
            <div class="so-sidebar-nav-label">Navigasi</div>
            <a href="{{ route('standowner.dashboard') }}" class="so-sidebar-nav-item">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <a href="{{ route('standowner.menu.index') }}" class="so-sidebar-nav-item active">
                <i class="bi bi-journal-text"></i> Daftar Menu
            </a>
            <a href="{{ route('standowner.menu.create') }}" class="so-sidebar-nav-item">
                <i class="bi bi-plus-circle"></i> Tambah Menu
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="so-form-content">

        <!-- Breadcrumb -->
        <div class="breadcrumb-so">
            <a href="{{ route('standowner.dashboard') }}"><i class="bi bi-house-door-fill"></i> Dashboard</a>
            <i class="bi bi-chevron-right" style="font-size:0.65rem;"></i>
            <a href="{{ route('standowner.menu.index') }}">Daftar Menu</a>
            <i class="bi bi-chevron-right" style="font-size:0.65rem;"></i>
            <span>Tambah Menu Baru</span>
        </div>

        <div class="so-form-panel">
            <div class="so-form-panel-header">
                <h4><i class="bi bi-plus-circle-fill" style="color:#81c408;"></i> Tambah Menu Baru</h4>
            </div>
            <div class="so-form-panel-body">

                @if($errors->any())
                <div class="so-alert-error">
                    <i class="bi bi-exclamation-triangle-fill" style="margin-top:2px;"></i>
                    <ul style="margin:0;padding-left:16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('standowner.menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">

                        <div style="grid-column:1/-1;">
                            <label class="so-label"><i class="bi bi-type"></i> Nama Menu</label>
                            <input type="text" name="nama" class="so-input"
                                placeholder="cth: Ayam Geprek Level 5"
                                value="{{ old('nama') }}" required>
                        </div>

                        <div>
                            <label class="so-label"><i class="bi bi-currency-dollar"></i> Harga (Rp)</label>
                            <input type="number" name="harga" class="so-input"
                                placeholder="cth: 15000"
                                value="{{ old('harga') }}" min="0" required>
                        </div>

                        <div>
                            <label class="so-label"><i class="bi bi-box-seam"></i> Stok</label>
                            <input type="number" name="stok" class="so-input"
                                placeholder="cth: 50"
                                value="{{ old('stok') }}" min="0" required>
                        </div>

                        <div>
                            <label class="so-label"><i class="bi bi-tag"></i> Kategori</label>
                            <select name="kategori" class="so-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="makanan" {{ old('kategori') === 'makanan' ? 'selected' : '' }}>🍛 Makanan</option>
                                <option value="minuman" {{ old('kategori') === 'minuman' ? 'selected' : '' }}>🥤 Minuman</option>
                                <option value="snack"   {{ old('kategori') === 'snack'   ? 'selected' : '' }}>🍿 Snack</option>
                            </select>
                        </div>

                        <div>
                            <label class="so-label"><i class="bi bi-toggle-on"></i> Status</label>
                            <div style="display:flex;align-items:center;gap:10px;padding:10px 0;">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch"
                                        {{ old('status', 'on') ? 'checked' : '' }}
                                        style="width:2.5rem;height:1.3rem;cursor:pointer;">
                                    <label class="form-check-label" for="statusSwitch"
                                        style="font-weight:700;font-size:0.88rem;color:#555;cursor:pointer;">
                                        Menu Aktif (tampil ke pelanggan)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div style="grid-column:1/-1;">
                            <label class="so-label"><i class="bi bi-card-text"></i> Deskripsi <span style="font-weight:400;color:#bbb;">(opsional)</span></label>
                            <input type="text" name="deskripsi" class="so-input"
                                placeholder="Deskripsi singkat menu ini..."
                                value="{{ old('deskripsi') }}">
                        </div>

                        <div style="grid-column:1/-1;">
                            <label class="so-label"><i class="bi bi-image"></i> Foto Menu <span style="font-weight:400;color:#bbb;">(opsional)</span></label>
                            <div class="so-file-input" onclick="document.getElementById('gambarInput').click()">
                                <i class="bi bi-cloud-arrow-up" style="font-size:1.5rem;color:#81c408;display:block;margin-bottom:6px;"></i>
                                <span id="fileLabel">Klik untuk pilih foto menu (JPG, PNG, maks 2MB)</span>
                                <input type="file" name="gambar" id="gambarInput" accept="image/*" style="display:none;"
                                    onchange="document.getElementById('fileLabel').textContent = this.files[0]?.name || 'Klik untuk pilih foto'">
                            </div>
                        </div>

                    </div>

                    <div style="display:flex;gap:12px;margin-top:24px;padding-top:20px;border-top:1px solid #f0f0f0;">
                        <button type="submit" class="so-btn-save">
                            <i class="bi bi-plus-circle-fill"></i> Simpan Menu
                        </button>
                        <a href="{{ route('standowner.menu.index') }}" class="so-btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </main>
</div>

@endsection
