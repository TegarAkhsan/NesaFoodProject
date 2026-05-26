@extends('layouts.app')
@section('title', 'NesaFood - Keranjang Belanja')
@section('content')

<style>
    /* =============================================
       CART PAGE STYLES
    ============================================= */
    .cart-page-wrapper {
        min-height: 100vh;
        background: linear-gradient(160deg, #f0f7eb 0%, #f9f9f9 60%, #fff 100%);
        padding-top: 100px;
        padding-bottom: 60px;
    }

    .cart-page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1b4332;
        letter-spacing: -0.5px;
    }

    .cart-page-title span {
        color: var(--nesa-primary);
    }

    .cart-badge-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--nesa-primary);
        color: #fff;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 2px 10px;
        margin-left: 8px;
        vertical-align: middle;
    }

    /* ---- Card Panel ---- */
    .cart-panel {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(27, 67, 50, 0.07);
        border: 1px solid rgba(129, 196, 8, 0.12);
        overflow: hidden;
    }

    .cart-panel-header {
        padding: 20px 28px 16px;
        border-bottom: 1px solid #f0f0f0;
        background: linear-gradient(90deg, #f0f7eb, #fff);
    }

    .cart-panel-header h5 {
        font-weight: 700;
        color: #1b4332;
        font-size: 1.05rem;
        margin: 0;
    }

    /* ---- Cart Item Row ---- */
    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 28px;
        border-bottom: 1px solid #f5f5f5;
        transition: background 0.2s;
    }

    .cart-item-row:last-child {
        border-bottom: none;
    }

    .cart-item-row:hover {
        background: #f9fdf4;
    }

    .cart-item-icon {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, #eaf5d3, #d5edb0);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .cart-item-name {
        font-weight: 700;
        color: #1b4332;
        font-size: 0.97rem;
        margin-bottom: 2px;
    }

    .cart-item-price {
        font-size: 0.85rem;
        color: #888;
    }

    .cart-item-subtotal {
        font-weight: 700;
        color: var(--nesa-primary);
        font-size: 1rem;
        white-space: nowrap;
    }

    /* ---- Qty Controls ---- */
    .qty-control {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f3f3f3;
        border-radius: 50px;
        padding: 4px 8px;
    }

    .qty-btn {
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 50%;
        background: #fff;
        color: #1b4332;
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: all 0.2s;
        line-height: 1;
    }

    .qty-btn:hover {
        background: var(--nesa-primary);
        color: #fff;
        transform: scale(1.1);
    }

    .qty-value {
        font-weight: 700;
        color: #1b4332;
        min-width: 20px;
        text-align: center;
        font-size: 0.95rem;
    }

    /* ---- Remove Button ---- */
    .btn-remove-item {
        background: none;
        border: none;
        color: #ccc;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 4px 6px;
        border-radius: 8px;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .btn-remove-item:hover {
        color: #e53935;
        background: #fff0f0;
    }

    /* ---- Notes Section ---- */
    .notes-section {
        padding: 20px 28px;
        border-top: 1px solid #f0f0f0;
        background: #fafafa;
    }

    .notes-section label {
        font-weight: 600;
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .notes-textarea {
        border: 1.5px solid #e5e5e5;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.9rem;
        width: 100%;
        resize: none;
        color: #333;
        background: #fff;
        transition: border-color 0.2s;
        outline: none;
    }

    .notes-textarea:focus {
        border-color: var(--nesa-primary);
        box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.12);
    }

    /* ---- Cart Actions ---- */
    .cart-actions {
        padding: 20px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        border-top: 1px solid #f0f0f0;
    }

    .btn-clear-cart {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 22px;
        border-radius: 50px;
        border: 1.5px solid #e0e0e0;
        background: #fff;
        color: #e53935;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-clear-cart:hover {
        border-color: #e53935;
        background: #fff5f5;
        color: #e53935;
    }

    /* ---- Summary Panel ---- */
    .summary-panel {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(27, 67, 50, 0.07);
        border: 1px solid rgba(129, 196, 8, 0.12);
        position: sticky;
        top: 100px;
    }

    .summary-header {
        padding: 20px 24px 16px;
        border-bottom: 1px solid #f0f0f0;
        background: linear-gradient(135deg, #1b4332, #27643f);
        border-radius: 20px 20px 0 0;
    }

    .summary-header h5 {
        font-weight: 700;
        color: #fff;
        margin: 0;
        font-size: 1rem;
    }

    .summary-body {
        padding: 20px 24px;
    }

    .summary-item-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 14px;
        font-size: 0.9rem;
    }

    .summary-item-name {
        color: #555;
        flex: 1;
        line-height: 1.4;
    }

    .summary-item-name small {
        display: block;
        color: #aaa;
        font-size: 0.78rem;
    }

    .summary-item-price {
        font-weight: 700;
        color: #1b4332;
        white-space: nowrap;
    }

    .summary-divider {
        border: none;
        border-top: 1px solid #f0f0f0;
        margin: 16px 0;
    }

    .summary-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .summary-total-label {
        font-weight: 700;
        color: #1b4332;
        font-size: 1rem;
    }

    .summary-total-amount {
        font-weight: 800;
        color: var(--nesa-primary);
        font-size: 1.3rem;
    }

    /* ---- Promo Input ---- */
    .promo-input-group {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
    }

    .promo-input {
        flex: 1;
        border: 1.5px solid #e5e5e5;
        border-radius: 10px;
        padding: 9px 14px;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.2s;
    }

    .promo-input:focus {
        border-color: var(--nesa-primary);
    }

    .promo-btn {
        background: var(--nesa-primary-light);
        border: 1.5px solid var(--nesa-primary);
        color: #1b4332;
        border-radius: 10px;
        padding: 9px 16px;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .promo-btn:hover {
        background: var(--nesa-primary);
        color: #fff;
    }

    /* ---- Checkout Button ---- */
    .btn-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #81c408, #6ea406);
        color: #fff;
        font-weight: 800;
        font-size: 1rem;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        letter-spacing: 0.3px;
        transition: all 0.3s;
        box-shadow: 0 4px 20px rgba(129, 196, 8, 0.35);
        text-decoration: none;
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(129, 196, 8, 0.5);
        color: #fff;
    }

    .btn-checkout:active {
        transform: translateY(0);
    }

    /* ---- Continue Shopping ---- */
    .continue-shopping-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 0.85rem;
        color: #888;
        text-decoration: none;
        margin-top: 14px;
        transition: color 0.2s;
    }

    .continue-shopping-link:hover {
        color: var(--nesa-primary);
    }

    /* ---- Empty Cart ---- */
    .empty-cart-box {
        text-align: center;
        padding: 80px 40px;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 8px 40px rgba(27, 67, 50, 0.07);
        border: 1px solid rgba(129, 196, 8, 0.1);
    }

    .empty-cart-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #eaf5d3, #d5edb0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 2.5rem;
    }

    .empty-cart-box h3 {
        font-weight: 800;
        color: #1b4332;
        margin-bottom: 10px;
    }

    .empty-cart-box p {
        color: #999;
        font-size: 0.95rem;
        margin-bottom: 28px;
    }

    .btn-shop-now {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 32px;
        background: linear-gradient(135deg, #81c408, #6ea406);
        color: #fff;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        box-shadow: 0 4px 20px rgba(129, 196, 8, 0.3);
        transition: all 0.3s;
    }

    .btn-shop-now:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(129, 196, 8, 0.45);
        color: #fff;
    }

    /* ---- Breadcrumb ---- */
    .cart-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: #aaa;
        margin-bottom: 24px;
    }

    .cart-breadcrumb a {
        color: var(--nesa-primary);
        text-decoration: none;
        font-weight: 600;
    }

    .cart-breadcrumb a:hover {
        text-decoration: underline;
    }
</style>

<div class="cart-page-wrapper">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="cart-breadcrumb">
            <a href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i> Beranda</a>
            <i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>
            <span>Keranjang Belanja</span>
        </div>

        <!-- Page Title -->
        <div class="d-flex align-items-center mb-4">
            <h2 class="cart-page-title mb-0">Keranjang <span>Belanja</span></h2>
            @if(count($items) > 0)
                <span class="cart-badge-count">{{ count($items) }} item</span>
            @endif
        </div>

        @if(count($items) > 0)
        <form action="{{ route('cart.checkout') }}" method="POST" id="cart-form">
            @csrf
            <div class="row g-4 align-items-start">

                {{-- LEFT: Cart Items --}}
                <div class="col-lg-8">
                    <div class="cart-panel">
                        <!-- Panel Header -->
                        <div class="cart-panel-header d-flex align-items-center justify-content-between">
                            <h5><i class="bi bi-bag-check me-2" style="color:var(--nesa-primary);"></i>Item Pesanan</h5>
                            <span style="font-size:0.82rem;color:#999;">{{ count($items) }} produk dipilih</span>
                        </div>

                        <!-- Item List -->
                        @foreach($items as $item)
                        <div class="cart-item-row" data-item-id="{{ $item['id'] }}">
                            <!-- Icon -->
                            <div class="cart-item-icon">🍽️</div>

                            <!-- Info -->
                            <div class="flex-grow-1 min-width-0">
                                <div class="cart-item-name">{{ $item['name'] }}</div>
                                <div class="cart-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }} / porsi</div>
                            </div>

                            <!-- Qty Controls -->
                            <div class="qty-control">
                                <button type="button" class="qty-btn btn-update"
                                    data-id="{{ $item['id'] }}" data-type="decrease"
                                    title="Kurangi jumlah">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <span class="qty-value">{{ $item['quantity'] }}</span>
                                <button type="button" class="qty-btn btn-update"
                                    data-id="{{ $item['id'] }}" data-type="increase"
                                    title="Tambah jumlah">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>

                            <!-- Subtotal -->
                            <div class="cart-item-subtotal" style="min-width:110px;text-align:right;">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </div>

                            <!-- Remove -->
                            <button type="button" class="btn-remove-item btn-remove"
                                data-id="{{ $item['id'] }}"
                                title="Hapus item">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        @endforeach

                        <!-- Notes Section -->
                        <div class="notes-section">
                            <label for="catatan"><i class="bi bi-pencil-square me-1"></i> Catatan Tambahan</label>
                            <textarea id="catatan" name="catatan" class="notes-textarea" rows="3"
                                placeholder="Contoh: tanpa sambal, porsi besar, dll...">{{ session('checkout_note') }}</textarea>
                        </div>

                        <!-- Bottom Actions -->
                        <div class="cart-actions">
                            <a href="{{ route('cart.clear') }}"
                               class="btn-clear-cart"
                               onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
                                <i class="bi bi-trash3"></i> Kosongkan Keranjang
                            </a>
                            <a href="{{ url('/menu') }}" style="font-size:0.85rem;color:#888;text-decoration:none;display:flex;align-items:center;gap:6px;">
                                <i class="bi bi-arrow-left"></i> Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Order Summary --}}
                <div class="col-lg-4">
                    <div class="summary-panel">
                        <!-- Header -->
                        <div class="summary-header">
                            <h5><i class="bi bi-receipt-cutoff me-2"></i>Ringkasan Pesanan</h5>
                        </div>

                        <div class="summary-body">
                            <!-- Item List Summary -->
                            @php $grandTotal = 0; @endphp
                            @foreach($items as $item)
                                @php
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $grandTotal += $subtotal;
                                @endphp
                                <div class="summary-item-row">
                                    <div class="summary-item-name">
                                        {{ $item['name'] }}
                                        <small>{{ $item['quantity'] }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                                    </div>
                                    <div class="summary-item-price">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach

                            <hr class="summary-divider">

                            <!-- Promo Code -->
                            <div style="margin-bottom:8px;">
                                <label style="font-size:0.82rem;font-weight:600;color:#777;margin-bottom:6px;display:block;">
                                    <i class="bi bi-tag me-1"></i>Kode Promo
                                </label>
                                <div class="promo-input-group">
                                    <input type="text" name="promo" id="promo"
                                        class="promo-input" placeholder="Masukkan kode promo">
                                    <button type="button" class="promo-btn" id="applyPromoBtn">
                                        Terapkan
                                    </button>
                                </div>
                            </div>

                            <hr class="summary-divider">

                            <!-- Total -->
                            <div class="summary-total-row">
                                <span class="summary-total-label">Total Pembayaran</span>
                                <span class="summary-total-amount" id="grandTotalDisplay">
                                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Checkout Button -->
                            <button type="submit" class="btn-checkout" form="cart-form">
                                <i class="bi bi-lightning-charge-fill"></i>
                                Lanjut ke Checkout
                                <i class="bi bi-arrow-right"></i>
                            </button>

                            <!-- Continue Shopping -->
                            <a href="{{ url('/menu') }}" class="continue-shopping-link">
                                <i class="bi bi-arrow-left-circle"></i>
                                Lanjut Belanja
                            </a>

                            <!-- Info -->
                            <div style="margin-top:18px;padding:12px 14px;background:#f9fdf4;border-radius:12px;border:1px solid #e0f0c0;">
                                <div style="font-size:0.78rem;color:#666;display:flex;align-items:flex-start;gap:8px;">
                                    <i class="bi bi-shield-check-fill" style="color:var(--nesa-primary);margin-top:1px;"></i>
                                    <span>Pesanan Anda aman & terlindungi. Kami menjamin keamanan transaksi Anda di NesaFood.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @else
        {{-- Empty Cart State --}}
        <div class="empty-cart-box" data-aos="fade-up">
            <div class="empty-cart-icon">🛒</div>
            <h3>Keranjang Masih Kosong</h3>
            <p>Tambahkan menu favoritmu dari stand-stand terbaik di Food Court UNESA!</p>
            <a href="{{ url('/menu') }}" class="btn-shop-now">
                <i class="bi bi-shop"></i> Jelajahi Menu
            </a>
        </div>
        @endif

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ---- Update Quantity ----
    document.querySelectorAll('.btn-update').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.dataset.id;
            const type   = this.dataset.type;

            // Optimistic UI: update qty value display
            const row = this.closest('.cart-item-row');
            const qtyEl = row ? row.querySelector('.qty-value') : null;
            if (qtyEl && type === 'increase') {
                qtyEl.textContent = parseInt(qtyEl.textContent) + 1;
            } else if (qtyEl && type === 'decrease') {
                const newQty = parseInt(qtyEl.textContent) - 1;
                if (newQty <= 0) {
                    if (row) row.style.opacity = '0.4';
                }
                qtyEl.textContent = Math.max(0, newQty);
            }

            fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ id: itemId, type: type })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) { location.reload(); }
            })
            .catch(() => location.reload());
        });
    });

    // ---- Remove Item ----
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.dataset.id;
            const row = this.closest('.cart-item-row');

            if (row) {
                row.style.transition = 'all 0.3s';
                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';
            }

            setTimeout(() => {
                fetch("{{ url('cart/remove') }}/" + itemId, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) { location.reload(); }
                })
                .catch(() => location.reload());
            }, 300);
        });
    });

    // ---- Promo Button Feedback ----
    const promoBtn = document.getElementById('applyPromoBtn');
    if (promoBtn) {
        promoBtn.addEventListener('click', function () {
            const promoVal = document.getElementById('promo').value.trim();
            if (!promoVal) {
                alert('Masukkan kode promo terlebih dahulu.');
                return;
            }
            // Simple feedback (actual discount handled server-side at checkout)
            promoBtn.textContent = '✓ Diterapkan';
            promoBtn.style.background = 'var(--nesa-primary)';
            promoBtn.style.color = '#fff';
        });
    }
});
</script>

@endsection
