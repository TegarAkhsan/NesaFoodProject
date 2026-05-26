@extends('layouts.standowner')
@section('title', 'Daftar Menu Stand')
@section('content')

<style>
.so-form-page { display: flex; min-height: 100vh; padding-top: 0; background: #f4f6f9; }
.so-form-sidebar { width: 240px; flex-shrink: 0; background: linear-gradient(180deg, #1b4332 0%, #0f2419 100%); display: flex; flex-direction: column; position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; box-shadow: 4px 0 20px rgba(0,0,0,0.15); }
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

.so-panel { background: #fff; border-radius: 18px; box-shadow: 0 2px 16px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; overflow: hidden; }
.so-panel-header { display: flex; align-items: center; justify-content: space-between; padding: 18px 24px; border-bottom: 1px solid #f5f5f5; background: linear-gradient(90deg, #f8fdf4, #fff); }
.so-panel-header h5 { font-weight: 800; color: #1b4332; font-size: 0.95rem; margin: 0; display: flex; align-items: center; gap: 8px; }

.so-table { width: 100%; border-collapse: collapse; font-size: 0.87rem; }
.so-table th { font-size: 0.72rem; font-weight: 700; color: #aaa; text-transform: uppercase; letter-spacing: 0.6px; padding: 10px 16px; border-bottom: 1px solid #f0f0f0; background: #fafafa; text-align: left; }
.so-table td { padding: 14px 16px; border-bottom: 1px solid #f8f8f8; vertical-align: middle; color: #444; }
.so-table tr:last-child td { border-bottom: none; }
.so-table tr:hover td { background: #fafdf5; }

.so-menu-img { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; border: 1px solid #f0f0f0; }
.so-menu-no-img { width: 48px; height: 48px; border-radius: 10px; background: linear-gradient(135deg, #eaf5d3, #d5edb0); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }

.so-badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; }
.so-badge-active   { background: #d1fae5; color: #065f46; }
.so-badge-inactive { background: #f3f4f6; color: #6b7280; }

.so-btn-primary { display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px; background: linear-gradient(135deg, #81c408, #6ea406); color: #fff; border: none; border-radius: 10px; font-weight: 700; font-size: 0.87rem; cursor: pointer; transition: all 0.2s; text-decoration: none; box-shadow: 0 3px 12px rgba(129,196,8,0.3); }
.so-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 5px 18px rgba(129,196,8,0.4); color: #fff; }
.so-btn-edit { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; background: #fff8e1; color: #f59e0b; border: 1px solid #fde68a; border-radius: 8px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s; text-decoration: none; }
.so-btn-edit:hover { background: #f59e0b; color: #fff; border-color: #f59e0b; }
.so-btn-danger { display: inline-flex; align-items: center; gap: 5px; padding: 6px 12px; background: #fff5f5; color: #e53935; border: 1px solid #ffcdd2; border-radius: 8px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s; }
.so-btn-danger:hover { background: #e53935; color: #fff; border-color: #e53935; }

.breadcrumb-so { display: flex; align-items: center; gap: 8px; font-size: 0.83rem; color: #aaa; margin-bottom: 20px; }
.breadcrumb-so a { color: #81c408; text-decoration: none; font-weight: 600; }

.so-alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 16px; font-size: 0.87rem; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
.so-alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; border-radius: 10px; padding: 12px 16px; font-size: 0.87rem; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }

.page-title { font-size: 1.5rem; font-weight: 800; color: #1b4332; margin: 0; }
.page-sub   { font-size: 0.85rem; color: #999; margin: 2px 0 0; }
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
            <span>Daftar Menu</span>
        </div>

        <!-- Page Header -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
            <div>
                <h1 class="page-title">Daftar Menu Stand</h1>
                <p class="page-sub">Kelola semua menu yang tersedia di stand Anda</p>
            </div>
            <a href="{{ route('standowner.menu.create') }}" class="so-btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Menu Baru
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="so-alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="so-alert-error">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
        </div>
        @endif

        <!-- Menu Table -->
        <div class="so-panel">
            <div class="so-panel-header">
                <h5><i class="bi bi-list-ul" style="color:#81c408;"></i> Semua Menu ({{ $menus->count() }})</h5>
                <a href="{{ route('standowner.menu.create') }}" class="so-btn-primary" style="padding:7px 14px;font-size:0.8rem;">
                    <i class="bi bi-plus"></i> Tambah
                </a>
            </div>

            @if($menus->count() > 0)
            <div style="overflow-x:auto;">
                <table class="so-table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td>
                                <div style="font-weight:700;color:#1b4332;font-size:0.92rem;">{{ $menu->nama }}</div>
                                @if($menu->deskripsi)
                                    <div style="font-size:0.75rem;color:#bbb;margin-top:2px;">{{ Str::limit($menu->deskripsi, 35) }}</div>
                                @endif
                            </td>
                            <td style="font-weight:700;color:#1b4332;white-space:nowrap;">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </td>
                            <td>
                                <span style="font-weight:600;color:{{ ($menu->stok ?? 99) < 5 ? '#e53935' : '#555' }};">
                                    {{ $menu->stok ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size:0.78rem;color:#666;background:#f5f5f5;padding:3px 10px;border-radius:50px;font-weight:600;">
                                    {{ ucfirst($menu->kategori ?? '-') }}
                                </span>
                            </td>
                            <td>
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/' . $menu->gambar) }}"
                                         alt="{{ $menu->nama }}" class="so-menu-img" onerror="this.onerror=null; this.outerHTML='<div class=&quot;so-menu-no-img&quot;>🍴</div>';">
                                @else
                                    <div class="so-menu-no-img">🍴</div>
                                @endif
                            </td>
                            <td>
                                @if($menu->status ?? true)
                                    <span class="so-badge so-badge-active">● Aktif</span>
                                @else
                                    <span class="so-badge so-badge-inactive">● Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex;gap:6px;align-items:center;">
                                    <a href="{{ route('standowner.menu.edit', $menu->id) }}" class="so-btn-edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('standowner.menu.destroy', $menu->id) }}"
                                          method="POST" style="display:inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus menu {{ $menu->nama }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="so-btn-danger">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div style="text-align:center;padding:60px 20px;color:#ccc;">
                    <div style="font-size:3rem;margin-bottom:12px;">🍽️</div>
                    <div style="font-weight:800;color:#1b4332;font-size:1.1rem;margin-bottom:6px;">Belum ada menu</div>
                    <div style="color:#aaa;font-size:0.88rem;margin-bottom:20px;">Mulai tambahkan menu untuk stand Anda</div>
                    <a href="{{ route('standowner.menu.create') }}" class="so-btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Menu Pertama
                    </a>
                </div>
            @endif
        </div>

    </main>
</div>

@endsection
