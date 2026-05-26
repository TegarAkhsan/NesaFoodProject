@extends('layouts.standowner')
@section('title', 'Dashboard - ' . $standOwner->stand_name)
@section('content')

<style>
/* =====================================================
   STANDOWNER DASHBOARD — MODERN ADMIN PANEL STYLES
   Uses a dark sidebar + clean content area approach
 ===================================================== */

/* ---- Page Layout ---- */
.so-wrapper {
    display: flex;
    min-height: 100vh;
    padding-top: 0; /* no global navbar offset needed */
    background: #f4f6f9;
    font-family: 'Open Sans', sans-serif;
}

/* ---- Sidebar ---- */
.so-sidebar {
    width: 240px;
    flex-shrink: 0;
    background: linear-gradient(180deg, #1b4332 0%, #0f2419 100%);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; /* starts at the very top */
    bottom: 0;
    left: 0;
    z-index: 100;
    box-shadow: 4px 0 20px rgba(0,0,0,0.15);
    overflow-y: auto;
}

.so-sidebar-brand {
    padding: 24px 20px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.so-sidebar-brand .stand-name {
    font-size: 1rem;
    font-weight: 800;
    color: #fff;
    margin: 0 0 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.so-sidebar-brand .stand-role {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.5);
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.so-nav {
    padding: 12px 0;
    flex: 1;
}

.so-nav-label {
    font-size: 0.68rem;
    font-weight: 700;
    color: rgba(255,255,255,0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 10px 20px 4px;
}

.so-nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 20px;
    color: rgba(255,255,255,0.65);
    text-decoration: none;
    font-size: 0.88rem;
    font-weight: 600;
    transition: all 0.2s;
    border-left: 3px solid transparent;
    cursor: pointer;
}

.so-nav-item:hover {
    background: rgba(129, 196, 8, 0.1);
    color: #a8d66e;
    border-left-color: rgba(129,196,8,0.4);
}

.so-nav-item.active {
    background: rgba(129, 196, 8, 0.15);
    color: #81c408;
    border-left-color: #81c408;
}

.so-nav-item i {
    width: 18px;
    text-align: center;
    font-size: 1rem;
}

.so-sidebar-footer {
    padding: 16px 20px;
    border-top: 1px solid rgba(255,255,255,0.08);
}

.so-logout-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.5);
    font-size: 0.83rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    transition: color 0.2s;
}

.so-logout-btn:hover {
    color: #ff6b6b;
}

/* ---- Main Content ---- */
.so-content {
    margin-left: 240px;
    flex: 1;
    padding: 28px 32px;
    min-height: 100vh; /* full viewport height */
}
}

/* ---- Page Header ---- */
.so-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 12px;
}

.so-page-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #1b4332;
    margin: 0;
}

.so-page-subtitle {
    font-size: 0.85rem;
    color: #999;
    margin: 2px 0 0;
}

/* ---- Section Tabs ---- */
.so-tabs {
    display: flex;
    gap: 4px;
    background: #fff;
    border-radius: 14px;
    padding: 5px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    margin-bottom: 28px;
    flex-wrap: wrap;
}

.so-tab {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 9px 18px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 700;
    color: #888;
    cursor: pointer;
    border: none;
    background: none;
    transition: all 0.2s;
}

.so-tab:hover {
    background: #f5f5f5;
    color: #333;
}

.so-tab.active {
    background: linear-gradient(135deg, #1b4332, #27643f);
    color: #fff;
    box-shadow: 0 4px 12px rgba(27,67,50,0.25);
}

/* ---- Stat Cards ---- */
.so-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}

.so-stat-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.05);
    border: 1px solid #f0f0f0;
    position: relative;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}

.so-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.09);
}

.so-stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 16px 16px 0 0;
}

.so-stat-card.green::before  { background: linear-gradient(90deg, #81c408, #6ea406); }
.so-stat-card.teal::before   { background: linear-gradient(90deg, #1b4332, #27643f); }
.so-stat-card.amber::before  { background: linear-gradient(90deg, #f59e0b, #d97706); }
.so-stat-card.violet::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }

.so-stat-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-bottom: 14px;
}

.so-stat-card.green  .so-stat-icon { background: #f0f7e6; color: #81c408; }
.so-stat-card.teal   .so-stat-icon { background: #e6f0ea; color: #1b4332; }
.so-stat-card.amber  .so-stat-icon { background: #fef3c7; color: #f59e0b; }
.so-stat-card.violet .so-stat-icon { background: #ede9fe; color: #8b5cf6; }

.so-stat-value {
    font-size: 1.7rem;
    font-weight: 900;
    color: #1b4332;
    line-height: 1;
    margin-bottom: 4px;
}

.so-stat-label {
    font-size: 0.78rem;
    color: #aaa;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ---- Content Panels ---- */
.so-panel {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.05);
    border: 1px solid #f0f0f0;
    margin-bottom: 24px;
    overflow: hidden;
}

.so-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    border-bottom: 1px solid #f5f5f5;
    background: linear-gradient(90deg, #f8fdf4, #fff);
}

.so-panel-header h5 {
    font-weight: 800;
    color: #1b4332;
    font-size: 0.95rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.so-panel-body {
    padding: 24px;
}

/* ---- Styled Form Inputs ---- */
.so-form-group {
    margin-bottom: 14px;
}

.so-form-label {
    font-size: 0.8rem;
    font-weight: 700;
    color: #666;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.so-input,
.so-select,
.so-textarea {
    width: 100%;
    border: 1.5px solid #e8e8e8;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.88rem;
    color: #333;
    background: #fafafa;
    outline: none;
    transition: all 0.2s;
    font-family: inherit;
    display: block;
}

.so-input:focus,
.so-select:focus,
.so-textarea:focus {
    border-color: #81c408;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(129,196,8,0.1);
}

.so-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%231b4332' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-color: #fafafa;
    padding-right: 36px;
}

/* ---- Buttons ---- */
.so-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #81c408, #6ea406);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.87rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    box-shadow: 0 3px 12px rgba(129,196,8,0.3);
}

.so-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 18px rgba(129,196,8,0.4);
    color: #fff;
}

.so-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 18px;
    background: transparent;
    color: #1b4332;
    border: 1.5px solid #d0e8c0;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.87rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.so-btn-outline:hover {
    background: #f0f7e6;
    border-color: #81c408;
    color: #1b4332;
}

.so-btn-danger {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    background: #fff5f5;
    color: #e53935;
    border: 1px solid #ffcdd2;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.so-btn-danger:hover {
    background: #e53935;
    color: #fff;
    border-color: #e53935;
}

.so-btn-edit {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    background: #fff8e1;
    color: #f59e0b;
    border: 1px solid #fde68a;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.so-btn-edit:hover {
    background: #f59e0b;
    color: #fff;
    border-color: #f59e0b;
}

/* ---- Menu Table ---- */
.so-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.87rem;
}

.so-table th {
    font-size: 0.72rem;
    font-weight: 700;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 10px 14px;
    border-bottom: 1px solid #f0f0f0;
    background: #fafafa;
    text-align: left;
}

.so-table td {
    padding: 13px 14px;
    border-bottom: 1px solid #f8f8f8;
    vertical-align: middle;
    color: #444;
}

.so-table tr:last-child td {
    border-bottom: none;
}

.so-table tr:hover td {
    background: #fafdf5;
}

.so-menu-img {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #f0f0f0;
}

.so-menu-no-img {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: linear-gradient(135deg, #eaf5d3, #d5edb0);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

/* ---- Status Badge ---- */
.so-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
}

.so-badge-active   { background: #d1fae5; color: #065f46; }
.so-badge-inactive { background: #f3f4f6; color: #6b7280; }
.so-badge-pending  { background: #fef3c7; color: #92400e; }
.so-badge-paid     { background: #d1fae5; color: #065f46; }

/* ---- Order Card ---- */
.so-order-card {
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 12px;
    transition: all 0.2s;
    background: #fff;
}

.so-order-card:hover {
    border-color: rgba(129,196,8,0.3);
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
}

.so-order-card:last-child {
    margin-bottom: 0;
}

.so-order-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}

.so-order-menu {
    font-weight: 700;
    color: #1b4332;
    font-size: 0.92rem;
}

.so-order-amount {
    font-weight: 800;
    color: #81c408;
    font-size: 0.95rem;
}

.so-order-meta {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 10px;
}

.so-order-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

/* ---- Section visibility controlled by JS ---- */
.so-section { display: none; }
.so-section.active { display: block; }

/* ---- Alert ---- */
.so-alert {
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 0.87rem;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.so-alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
.so-alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

/* ---- Responsive ---- */
@media (max-width: 900px) {
    .so-sidebar { width: 200px; }
    .so-content { margin-left: 200px; padding: 20px; }
    .so-stats-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
    .so-sidebar { display: none; }
    .so-content { margin-left: 0; }
    .so-stats-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>

<div class="so-wrapper">

    {{-- ========== SIDEBAR ========== --}}
    <aside class="so-sidebar">
        <div class="so-sidebar-brand">
            <div style="font-size:1.3rem;margin-bottom:8px;">🍽️</div>
            <div class="stand-name">{{ $standOwner->stand_name }}</div>
            <div class="stand-role">Stand Owner Panel</div>
        </div>

        <nav class="so-nav">
            <div class="so-nav-label">Utama</div>
            <a class="so-nav-item active" onclick="switchTab('overview')" id="nav-overview">
                <i class="bi bi-grid-fill"></i> Ringkasan
            </a>
            <a class="so-nav-item" onclick="switchTab('orders')" id="nav-orders">
                <i class="bi bi-bag-check-fill"></i> Order Masuk
            </a>

            <div class="so-nav-label" style="margin-top:8px;">Manajemen</div>
            <a class="so-nav-item" onclick="switchTab('menu')" id="nav-menu">
                <i class="bi bi-journal-text"></i> Kelola Menu
            </a>
            <a class="so-nav-item" onclick="switchTab('promo')" id="nav-promo">
                <i class="bi bi-tag-fill"></i> Promo
            </a>
            <a class="so-nav-item" onclick="switchTab('report')" id="nav-report">
                <i class="bi bi-bar-chart-fill"></i> Laporan
            </a>

            <div class="so-nav-label" style="margin-top:8px;">Pengaturan</div>
            <a class="so-nav-item" onclick="switchTab('settings')" id="nav-settings">
                <i class="bi bi-gear-fill"></i> Pengaturan Stand
            </a>
        </nav>

        <div class="so-sidebar-footer">
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit" class="so-logout-btn">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ========== MAIN CONTENT ========== --}}
    <main class="so-content">

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="so-alert so-alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="so-alert so-alert-error">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
        </div>
        @endif

        {{-- Page Header --}}
        <div class="so-page-header">
            <div>
                <h1 class="so-page-title">Selamat Datang, {{ $standOwner->stand_name }} 👋</h1>
                <p class="so-page-subtitle">Pantau performa stand dan kelola menu Anda hari ini</p>
            </div>
            <a onclick="switchTab('menu')" class="so-btn-primary" style="cursor:pointer;">
                <i class="bi bi-plus-lg"></i> Tambah Menu
            </a>
        </div>

        {{-- ===== SECTION: OVERVIEW ===== --}}
        <div class="so-section active" id="section-overview">

            {{-- Stats --}}
            <div class="so-stats-grid">
                <div class="so-stat-card green">
                    <div class="so-stat-icon"><i class="bi bi-journal-check"></i></div>
                    <div class="so-stat-value">{{ $standOwner->menus->count() }}</div>
                    <div class="so-stat-label">Menu Aktif</div>
                </div>
                <div class="so-stat-card teal">
                    <div class="so-stat-icon"><i class="bi bi-bag-heart-fill"></i></div>
                    <div class="so-stat-value">{{ $orderItems->count() }}</div>
                    <div class="so-stat-label">Total Order</div>
                </div>
                <div class="so-stat-card amber">
                    <div class="so-stat-icon"><i class="bi bi-currency-dollar"></i></div>
                    <div class="so-stat-value" style="font-size:1.15rem;">
                        Rp {{ number_format($orderItems->sum('subtotal'), 0, ',', '.') }}
                    </div>
                    <div class="so-stat-label">Total Pendapatan</div>
                </div>
                <div class="so-stat-card violet">
                    <div class="so-stat-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="so-stat-value">{{ $orderItems->pluck('order_id')->unique()->count() }}</div>
                    <div class="so-stat-label">Unik Pelanggan</div>
                </div>
            </div>

            {{-- Quick View: Latest Orders --}}
            <div class="so-panel">
                <div class="so-panel-header">
                    <h5><i class="bi bi-clock-history" style="color:#81c408;"></i> Order Terbaru</h5>
                    <a onclick="switchTab('orders')" class="so-btn-outline" style="font-size:0.8rem;cursor:pointer;">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="so-panel-body" style="padding:0;">
                    @forelse($orderItems->take(5) as $item)
                        <div style="display:flex;align-items:center;gap:14px;padding:14px 24px;border-bottom:1px solid #f8f8f8;">
                            <div style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#eaf5d3,#d5edb0);display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
                                🍽️
                            </div>
                            <div style="flex:1;">
                                <div style="font-weight:700;color:#1b4332;font-size:0.9rem;">{{ $item->menu->name ?? $item->name }}</div>
                                <div style="font-size:0.78rem;color:#aaa;">{{ $item->order->customer_name ?? $item->order->name ?? '-' }} · {{ $item->order->address ?? '-' }}</div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:800;color:#81c408;font-size:0.9rem;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                <span class="so-badge so-badge-{{ $item->order->status === 'paid' ? 'paid' : 'pending' }}">
                                    {{ ucfirst($item->order->status ?? 'pending') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div style="padding:40px;text-align:center;color:#ccc;">
                            <div style="font-size:2.5rem;margin-bottom:10px;">📭</div>
                            <div style="font-weight:700;color:#999;">Belum ada order masuk</div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Quick View: Menu List --}}
            <div class="so-panel">
                <div class="so-panel-header">
                    <h5><i class="bi bi-journal-text" style="color:#81c408;"></i> Menu Saya ({{ $menus->count() }})</h5>
                    <a onclick="switchTab('menu')" class="so-btn-outline" style="font-size:0.8rem;cursor:pointer;">
                        Kelola Menu <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="so-table">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus->take(5) as $menu)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        @if($menu->image ?? $menu->gambar)
                                            <img src="{{ asset('storage/' . ($menu->image ?? $menu->gambar)) }}" class="so-menu-img" alt="">
                                        @else
                                            <div class="so-menu-no-img">🍴</div>
                                        @endif
                                        <div>
                                            <div style="font-weight:700;color:#1b4332;">{{ $menu->name ?? $menu->nama }}</div>
                                            <div style="font-size:0.75rem;color:#aaa;">{{ $menu->kategori ?? $menu->type ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight:700;">Rp {{ number_format($menu->price ?? $menu->harga ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $menu->stock ?? $menu->stok ?? '-' }}</td>
                                <td>
                                    @if($menu->status ?? true)
                                        <span class="so-badge so-badge-active">● Aktif</span>
                                    @else
                                        <span class="so-badge so-badge-inactive">● Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <a href="{{ route('standowner.menu.edit', $menu->id) }}" class="so-btn-edit">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('standowner.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="so-btn-danger" type="submit">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:30px;color:#ccc;">
                                    Belum ada menu
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ===== SECTION: ORDERS ===== --}}
        <div class="so-section" id="section-orders">
            <div class="so-page-header">
                <div>
                    <h2 style="font-size:1.2rem;font-weight:800;color:#1b4332;margin:0;">Order Masuk</h2>
                    <p style="color:#999;font-size:0.85rem;margin:2px 0 0;">Kelola semua pesanan yang masuk ke stand Anda</p>
                </div>
            </div>

            @forelse($orderItems as $item)
                <div class="so-panel" style="margin-bottom:14px;">
                    <div class="so-panel-body">
                        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#eaf5d3,#d5edb0);display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;">🍽️</div>
                                <div>
                                    <div style="font-weight:800;color:#1b4332;font-size:1rem;">{{ $item->menu->name ?? $item->name }}</div>
                                    <div style="font-size:0.83rem;color:#888;margin-top:2px;">
                                        <i class="bi bi-person me-1"></i>{{ $item->order->customer_name ?? $item->order->name ?? '-' }}
                                        &nbsp;·&nbsp;
                                        <i class="bi bi-geo-alt me-1"></i>{{ $item->order->address ?? '-' }}
                                    </div>
                                    <div style="font-size:0.8rem;color:#aaa;margin-top:2px;">
                                        {{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}
                                        @if($item->order->delivery_type ?? false)
                                            &nbsp;·&nbsp;
                                            {{ $item->order->delivery_type === 'diantar' ? '🛵 Diantar' : '🛍️ Diambil' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-weight:900;color:#81c408;font-size:1.1rem;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                <span class="so-badge so-badge-{{ $item->order->status === 'paid' ? 'paid' : 'pending' }}" style="margin-top:4px;">
                                    {{ ucfirst($item->order->status ?? 'pending') }}
                                </span>
                            </div>
                        </div>
                        <div style="margin-top:14px;padding-top:12px;border-top:1px solid #f5f5f5;display:flex;gap:8px;">
                            <form method="POST" action="" class="d-inline">
                                @csrf @method('PUT')
                                <button name="status" value="Selesai" class="so-btn-primary" style="padding:7px 14px;font-size:0.8rem;">
                                    <i class="bi bi-check-circle"></i> Selesai
                                </button>
                            </form>
                            <form method="POST" action="" class="d-inline">
                                @csrf @method('PUT')
                                <button name="status" value="Dibatalkan" class="so-btn-danger" style="padding:7px 14px;font-size:0.8rem;">
                                    <i class="bi bi-x-circle"></i> Batalkan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="so-panel">
                    <div class="so-panel-body" style="text-align:center;padding:60px 20px;">
                        <div style="font-size:3rem;margin-bottom:12px;">📭</div>
                        <div style="font-weight:800;color:#1b4332;font-size:1.1rem;margin-bottom:6px;">Belum ada order masuk</div>
                        <div style="color:#aaa;font-size:0.88rem;">Order dari pelanggan akan tampil di sini</div>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- ===== SECTION: KELOLA MENU ===== --}}
        <div class="so-section" id="section-menu">
            <div class="so-page-header">
                <div>
                    <h2 style="font-size:1.2rem;font-weight:800;color:#1b4332;margin:0;">Kelola Menu</h2>
                    <p style="color:#999;font-size:0.85rem;margin:2px 0 0;">Tambah, edit, dan hapus menu stand Anda</p>
                </div>
                <a href="{{ route('standowner.menu.create') }}" class="so-btn-primary">
                    <i class="bi bi-plus-lg"></i> Tambah Menu Baru
                </a>
            </div>

            {{-- Tambah Menu Form --}}
            <div class="so-panel mb-5">
                <div class="so-panel-header">
                    <h5><i class="bi bi-plus-circle" style="color:#81c408;"></i> Form Tambah Menu Cepat</h5>
                </div>
                <div class="so-panel-body">
                    <form action="{{ route('standowner.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                            <div class="so-alert so-alert-error">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-type"></i> Nama Menu</label>
                                <input type="text" name="nama" class="so-input" placeholder="cth: Ayam Geprek Spesial" value="{{ old('nama') }}" required>
                            </div>
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-currency-dollar"></i> Harga (Rp)</label>
                                <input type="number" name="harga" class="so-input" placeholder="cth: 15000" value="{{ old('harga') }}" required>
                            </div>
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-box-seam"></i> Stok</label>
                                <input type="number" name="stok" class="so-input" placeholder="cth: 50" value="{{ old('stok') }}" required>
                            </div>
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-tag"></i> Kategori</label>
                                <select name="kategori" class="so-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="makanan" {{ old('kategori') === 'makanan' ? 'selected' : '' }}>🍛 Makanan</option>
                                    <option value="minuman" {{ old('kategori') === 'minuman' ? 'selected' : '' }}>🥤 Minuman</option>
                                    <option value="snack"   {{ old('kategori') === 'snack'   ? 'selected' : '' }}>🍿 Snack</option>
                                </select>
                            </div>
                            <div class="so-form-group" style="grid-column:1/-1;">
                                <label class="so-form-label"><i class="bi bi-card-text"></i> Deskripsi</label>
                                <input type="text" name="deskripsi" class="so-input" placeholder="Deskripsi singkat menu..." value="{{ old('deskripsi') }}">
                            </div>
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-image"></i> Foto Menu (opsional)</label>
                                <input type="file" name="gambar" class="so-input" accept="image/*" style="padding:6px 14px;">
                            </div>
                            <div class="so-form-group" style="display:flex;align-items:flex-end;padding-bottom:14px;">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked style="width:2.5rem;height:1.3rem;cursor:pointer;">
                                        <label class="form-check-label" for="statusSwitch" style="font-weight:700;font-size:0.85rem;color:#555;cursor:pointer;">Menu Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="so-btn-primary" style="margin-top:4px;">
                            <i class="bi bi-plus-circle-fill"></i> Tambah Menu
                        </button>
                    </form>
                </div>
            </div>

            {{-- Menu Table --}}
            <div class="so-panel">
                <div class="so-panel-header">
                    <h5><i class="bi bi-list-ul" style="color:#81c408;"></i> Daftar Menu ({{ $menus->count() }})</h5>
                </div>
                <div style="overflow-x:auto;">
                    <table class="so-table">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        @if($menu->image ?? $menu->gambar)
                                            <img src="{{ asset('storage/' . ($menu->image ?? $menu->gambar)) }}" class="so-menu-img" alt="">
                                        @else
                                            <div class="so-menu-no-img">🍴</div>
                                        @endif
                                        <div>
                                            <div style="font-weight:700;color:#1b4332;font-size:0.9rem;">{{ $menu->name ?? $menu->nama }}</div>
                                            @if($menu->description ?? $menu->deskripsi)
                                                <div style="font-size:0.73rem;color:#bbb;">{{ Str::limit($menu->description ?? $menu->deskripsi, 30) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight:700;color:#1b4332;">Rp {{ number_format($menu->price ?? $menu->harga ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $menu->stock ?? $menu->stok ?? '-' }}</td>
                                <td>
                                    <span style="font-size:0.78rem;color:#666;background:#f5f5f5;padding:3px 10px;border-radius:50px;font-weight:600;">
                                        {{ ucfirst($menu->kategori ?? $menu->type ?? '-') }}
                                    </span>
                                </td>
                                <td>
                                    @if($menu->status ?? true)
                                        <span class="so-badge so-badge-active">● Aktif</span>
                                    @else
                                        <span class="so-badge so-badge-inactive">● Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <a href="{{ route('standowner.menu.edit', $menu->id) }}" class="so-btn-edit">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('standowner.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="so-btn-danger" type="submit">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align:center;padding:40px;color:#ccc;">
                                    <div style="font-size:2rem;margin-bottom:8px;">🍽️</div>
                                    Belum ada menu — tambahkan menu di atas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ===== SECTION: PROMO ===== --}}
        <div class="so-section" id="section-promo">
            <div class="so-page-header">
                <div>
                    <h2 style="font-size:1.2rem;font-weight:800;color:#1b4332;margin:0;">Kelola Promo</h2>
                    <p style="color:#999;font-size:0.85rem;margin:2px 0 0;">Atur kode promo dan diskon untuk pelanggan Anda</p>
                </div>
            </div>
            <div class="so-panel">
                <div class="so-panel-header">
                    <h5><i class="bi bi-ticket-perforated" style="color:#81c408;"></i> Buat Promo Baru</h5>
                </div>
                <div class="so-panel-body">
                    <form action="" method="POST">
                        @csrf
                        <div style="display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:14px;align-items:end;">
                            <div class="so-form-group" style="margin:0;">
                                <label class="so-form-label">Kode Promo</label>
                                <input type="text" name="kode" class="so-input" placeholder="cth: DISKON10">
                            </div>
                            <div class="so-form-group" style="margin:0;">
                                <label class="so-form-label">Diskon (%)</label>
                                <input type="number" name="diskon" class="so-input" placeholder="cth: 10">
                            </div>
                            <div class="so-form-group" style="margin:0;">
                                <label class="so-form-label">Berlaku Sampai</label>
                                <input type="date" name="berlaku_sampai" class="so-input">
                            </div>
                            <button type="submit" class="so-btn-primary" style="height:42px;">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="so-panel">
                <div class="so-panel-header">
                    <h5><i class="bi bi-list-task" style="color:#81c408;"></i> Daftar Promo Aktif</h5>
                </div>
                <div class="so-panel-body" style="text-align:center;color:#ccc;padding:40px;">
                    <div style="font-size:2.5rem;margin-bottom:10px;">🎟️</div>
                    <div style="font-weight:700;color:#999;">Belum ada promo yang dibuat</div>
                    <div style="font-size:0.83rem;margin-top:4px;">Buat promo di atas untuk menarik lebih banyak pelanggan</div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION: LAPORAN ===== --}}
        <div class="so-section" id="section-report">
            <div class="so-page-header">
                <div>
                    <h2 style="font-size:1.2rem;font-weight:800;color:#1b4332;margin:0;">Laporan Penjualan</h2>
                    <p style="color:#999;font-size:0.85rem;margin:2px 0 0;">Analisis pendapatan dan performa menu Anda</p>
                </div>
            </div>

            {{-- Stats Summary --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                <div class="so-panel" style="margin:0;">
                    <div class="so-panel-body" style="text-align:center;">
                        <div style="font-size:0.75rem;color:#aaa;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">Total Pendapatan</div>
                        <div style="font-size:1.8rem;font-weight:900;color:#81c408;">
                            Rp {{ number_format($orderItems->sum('subtotal'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="so-panel" style="margin:0;">
                    <div class="so-panel-body" style="text-align:center;">
                        <div style="font-size:0.75rem;color:#aaa;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;">Menu Terlaris</div>
                        <div style="font-size:1.3rem;font-weight:900;color:#1b4332;">
                            {{ $bestSeller ?? ($orderItems->sortByDesc('quantity')->first()?->menu?->name ?? '-') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="so-panel">
                <div class="so-panel-header">
                    <h5><i class="bi bi-funnel" style="color:#81c408;"></i> Filter Periode</h5>
                </div>
                <div class="so-panel-body">
                    <form method="GET" action="">
                        <div style="display:grid;grid-template-columns:1fr 1fr auto;gap:14px;align-items:end;">
                            <div class="so-form-group" style="margin:0;">
                                <label class="so-form-label">Dari Tanggal</label>
                                <input type="date" name="from" class="so-input">
                            </div>
                            <div class="so-form-group" style="margin:0;">
                                <label class="so-form-label">Sampai Tanggal</label>
                                <input type="date" name="to" class="so-input">
                            </div>
                            <button type="submit" class="so-btn-primary" style="height:42px;">
                                <i class="bi bi-search"></i> Filter
                            </button>
                        </div>
                    </form>
                    <div style="margin-top:20px;text-align:right;">
                        <a href="" class="so-btn-outline">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SECTION: PENGATURAN ===== --}}
        <div class="so-section" id="section-settings">
            <div class="so-page-header">
                <div>
                    <h2 style="font-size:1.2rem;font-weight:800;color:#1b4332;margin:0;">Pengaturan Stand</h2>
                    <p style="color:#999;font-size:0.85rem;margin:2px 0 0;">Kelola profil dan informasi stand Anda</p>
                </div>
            </div>
            <div class="so-panel">
                <div class="so-panel-header">
                    <h5><i class="bi bi-shop" style="color:#81c408;"></i> Informasi Stand</h5>
                </div>
                <div class="so-panel-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-shop"></i> Nama Stand</label>
                                <input type="text" name="stand_name" class="so-input" value="{{ $standOwner->stand_name }}">
                            </div>
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-envelope"></i> Email</label>
                                <input type="email" name="email" class="so-input" value="{{ $standOwner->email }}">
                            </div>
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-image"></i> Foto Logo</label>
                                <input type="file" name="logo" class="so-input" accept="image/*" style="padding:6px 14px;">
                            </div>
                            <div class="so-form-group">
                                <label class="so-form-label"><i class="bi bi-lock"></i> Password Baru <span style="font-weight:400;color:#bbb;">(opsional)</span></label>
                                <input type="password" name="password" class="so-input" placeholder="Biarkan kosong jika tidak diubah">
                            </div>
                        </div>
                        <button type="submit" class="so-btn-primary" style="margin-top:8px;">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
function switchTab(tab) {
    // Hide all sections
    document.querySelectorAll('.so-section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.so-nav-item').forEach(n => n.classList.remove('active'));

    // Show selected section
    const section = document.getElementById('section-' + tab);
    if (section) section.classList.add('active');

    // Activate nav item
    const nav = document.getElementById('nav-' + tab);
    if (nav) nav.classList.add('active');

    // Scroll to top of content
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Check if redirected with hash/error to open a specific tab
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash.replace('#', '');
    if (hash && document.getElementById('section-' + hash)) {
        switchTab(hash);
    }
});
</script>

@endsection
