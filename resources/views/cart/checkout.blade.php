@extends('layouts.app')
@section('title', 'NesaFood - Checkout')
@section('content')

<style>
    /* =============================================
       CHECKOUT PAGE STYLES
    ============================================= */
    .checkout-wrapper {
        min-height: 100vh;
        background: linear-gradient(160deg, #f0f7eb 0%, #f9f9f9 60%, #fff 100%);
        padding-top: 100px;
        padding-bottom: 60px;
    }

    .checkout-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1b4332;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }

    .checkout-title span {
        color: var(--nesa-primary);
    }

    .checkout-subtitle {
        font-size: 0.9rem;
        color: #999;
        margin-bottom: 28px;
    }

    /* ---- Steps Indicator ---- */
    .checkout-steps {
        display: flex;
        align-items: center;
        gap: 0;
        margin-bottom: 32px;
        background: #fff;
        border-radius: 16px;
        padding: 16px 24px;
        box-shadow: 0 4px 20px rgba(27,67,50,0.06);
        border: 1px solid rgba(129,196,8,0.1);
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
    }

    .step-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .step-circle.active {
        background: linear-gradient(135deg, #81c408, #6ea406);
        color: #fff;
        box-shadow: 0 4px 12px rgba(129,196,8,0.35);
    }

    .step-circle.done {
        background: #e8f5e9;
        color: var(--nesa-primary);
        border: 2px solid var(--nesa-primary);
    }

    .step-circle.pending {
        background: #f0f0f0;
        color: #bbb;
    }

    .step-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #1b4332;
    }

    .step-label.pending {
        color: #bbb;
    }

    .step-divider {
        flex: 1;
        height: 2px;
        background: #e0e0e0;
        margin: 0 8px;
        border-radius: 2px;
        max-width: 60px;
    }

    .step-divider.done {
        background: var(--nesa-primary);
    }

    /* ---- Form Panel ---- */
    .form-panel {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(27, 67, 50, 0.07);
        border: 1px solid rgba(129, 196, 8, 0.12);
        overflow: hidden;
    }

    .form-panel-header {
        padding: 18px 28px 14px;
        border-bottom: 1px solid #f0f0f0;
        background: linear-gradient(90deg, #f0f7eb, #fff);
    }

    .form-panel-header h5 {
        font-weight: 700;
        color: #1b4332;
        font-size: 1rem;
        margin: 0;
    }

    .form-panel-body {
        padding: 24px 28px;
    }

    /* ---- Styled Inputs ---- */
    .styled-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .styled-input,
    .styled-select,
    .styled-textarea {
        width: 100%;
        border: 1.5px solid #e5e5e5;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.92rem;
        color: #333;
        background: #fff;
        outline: none;
        transition: all 0.25s;
        margin-bottom: 20px;
        display: block;
        font-family: inherit;
    }

    .styled-input:focus,
    .styled-select:focus,
    .styled-textarea:focus {
        border-color: var(--nesa-primary);
        box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.12);
    }

    .styled-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%231b4332' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .styled-textarea {
        resize: vertical;
        min-height: 90px;
    }

    /* ---- Payment Method Cards ---- */
    .payment-method-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .payment-card-label {
        cursor: pointer;
    }

    .payment-card-label input[type="radio"] {
        display: none;
    }

    .payment-card-inner {
        border: 2px solid #e5e5e5;
        border-radius: 14px;
        padding: 14px 10px;
        text-align: center;
        transition: all 0.2s;
        background: #fff;
    }

    .payment-card-label input[type="radio"]:checked + .payment-card-inner {
        border-color: var(--nesa-primary);
        background: #f0f7eb;
        box-shadow: 0 4px 14px rgba(129, 196, 8, 0.18);
    }

    .payment-card-inner:hover {
        border-color: var(--nesa-primary);
        background: #f9fdf4;
    }

    .payment-card-icon {
        font-size: 1.6rem;
        margin-bottom: 6px;
    }

    .payment-card-name {
        font-size: 0.78rem;
        font-weight: 700;
        color: #1b4332;
    }

    /* ---- Summary Card ---- */
    .summary-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(27, 67, 50, 0.07);
        border: 1px solid rgba(129, 196, 8, 0.12);
        overflow: hidden;
        position: sticky;
        top: 100px;
    }

    .summary-card-header {
        padding: 18px 24px 14px;
        background: linear-gradient(135deg, #1b4332, #27643f);
        border-bottom: none;
    }

    .summary-card-header h5 {
        font-weight: 700;
        color: #fff;
        margin: 0;
        font-size: 1rem;
    }

    .summary-card-body {
        padding: 20px 24px;
    }

    .order-item-line {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 14px;
        font-size: 0.88rem;
    }

    .order-item-left {
        flex: 1;
        color: #555;
        line-height: 1.4;
    }

    .order-item-left small {
        display: block;
        font-size: 0.75rem;
        color: #bbb;
    }

    .order-item-right {
        font-weight: 700;
        color: #1b4332;
        white-space: nowrap;
    }

    .order-divider {
        border: none;
        border-top: 1px dashed #e5e5e5;
        margin: 14px 0;
    }

    .order-note-box {
        background: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 0.82rem;
        color: #777;
        margin-bottom: 16px;
        font-style: italic;
    }

    .order-total-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .order-total-label {
        font-weight: 700;
        color: #1b4332;
        font-size: 1rem;
    }

    .order-total-amount {
        font-weight: 900;
        color: var(--nesa-primary);
        font-size: 1.35rem;
    }

    /* ---- Submit Button ---- */
    .btn-place-order {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 16px;
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
    }

    .btn-place-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(129, 196, 8, 0.5);
    }

    .btn-place-order:active {
        transform: translateY(0);
    }

    /* ---- Back to Cart ---- */
    .back-to-cart-link {
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

    .back-to-cart-link:hover {
        color: var(--nesa-primary);
    }

    /* ---- Breadcrumb ---- */
    .co-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: #aaa;
        margin-bottom: 20px;
    }

    .co-breadcrumb a {
        color: var(--nesa-primary);
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="checkout-wrapper">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="co-breadcrumb">
            <a href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i> Beranda</a>
            <i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>
            <a href="{{ url('/cart') }}">Keranjang</a>
            <i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>
            <span>Checkout</span>
        </div>

        <!-- Page Title -->
        <h2 class="checkout-title">Proses <span>Checkout</span></h2>
        <p class="checkout-subtitle">Lengkapi data di bawah untuk menyelesaikan pesanan Anda</p>

        <!-- Steps Indicator -->
        <div class="checkout-steps">
            <div class="step-item">
                <div class="step-circle done"><i class="bi bi-check-lg"></i></div>
                <span class="step-label">Keranjang</span>
            </div>
            <div class="step-divider done"></div>
            <div class="step-item">
                <div class="step-circle active">2</div>
                <span class="step-label">Detail Pesanan</span>
            </div>
            <div class="step-divider"></div>
            <div class="step-item">
                <div class="step-circle pending">3</div>
                <span class="step-label pending">Konfirmasi</span>
            </div>
        </div>

        <div class="row g-4 align-items-start">

            {{-- LEFT: Checkout Form --}}
            <div class="col-lg-7">
                <form action="{{ route('cart.processCheckout') }}" method="POST" id="checkout-form">
                    @csrf

                    <!-- Data Pemesan -->
                    <div class="form-panel mb-4" data-aos="fade-up">
                        <div class="form-panel-header">
                            <h5><i class="bi bi-person-circle me-2" style="color:var(--nesa-primary);"></i>Data Pemesan</h5>
                        </div>
                        <div class="form-panel-body">

                            <!-- Nama -->
                            <label for="name" class="styled-label">
                                <i class="bi bi-person"></i> Nama Lengkap
                            </label>
                            <input type="text" name="name" id="name" class="styled-input"
                                placeholder="Masukkan nama lengkap Anda"
                                value="{{ old('name', auth()->user()->name ?? '') }}" required>

                            <!-- Alamat / Nomor Meja -->
                            <label for="address" class="styled-label">
                                <i class="bi bi-geo-alt"></i> Alamat / Nomor Meja
                            </label>
                            <textarea name="address" id="address" class="styled-textarea"
                                placeholder="Contoh: Meja 5, Gedung Kuliah A - atau - Lantai 2, dekat kasir" required>{{ old('address') }}</textarea>

                            <!-- Kode Promo -->
                            <label for="promo_code" class="styled-label">
                                <i class="bi bi-tag"></i> Kode Promo <span style="font-weight:400;color:#bbb;">(opsional)</span>
                            </label>
                            <input type="text" name="promo_code" id="promo_code" class="styled-input"
                                placeholder="Contoh: DISKON10"
                                value="{{ request()->get('promo') }}">

                        </div>
                    </div>

                    <!-- Cara Pengambilan -->
                    <div class="form-panel mb-4" data-aos="fade-up" data-aos-delay="80">
                        <div class="form-panel-header">
                            <h5><i class="bi bi-truck me-2" style="color:var(--nesa-primary);"></i>Cara Pengambilan</h5>
                        </div>
                        <div class="form-panel-body">

                            <label class="styled-label" style="margin-bottom:12px;">
                                Pilih cara penerimaan pesanan:
                            </label>

                            <div class="payment-method-group" style="grid-template-columns: 1fr 1fr;">
                                <label class="payment-card-label" id="label-diambil">
                                    <input type="radio" name="delivery_type" value="diambil" id="delivery-diambil" checked required>
                                    <div class="payment-card-inner">
                                        <div class="payment-card-icon">🛍️</div>
                                        <div class="payment-card-name">Diambil Sendiri</div>
                                        <div style="font-size:0.72rem;color:#888;margin-top:3px;">Bayar dulu, ambil di stand</div>
                                        <div style="font-size:0.78rem;font-weight:700;color:#27ae60;margin-top:4px;">Gratis</div>
                                    </div>
                                </label>
                                <label class="payment-card-label" id="label-diantar">
                                    <input type="radio" name="delivery_type" value="diantar" id="delivery-diantar">
                                    <div class="payment-card-inner">
                                        <div class="payment-card-icon">🛵</div>
                                        <div class="payment-card-name">Diantar</div>
                                        <div style="font-size:0.72rem;color:#888;margin-top:3px;">Dikirim ke meja / lokasi Anda</div>
                                        <div style="font-size:0.78rem;font-weight:700;color:var(--nesa-accent);margin-top:4px;">+ Rp 5.000</div>
                                    </div>
                                </label>
                            </div>

                            <!-- Info COD restriction -->
                            <div id="cod-restriction-note" class="d-none" style="background:#fff8e1;border:1px solid #ffe082;border-radius:10px;padding:10px 14px;font-size:0.82rem;color:#7c5a00;margin-top:4px;">
                                <i class="bi bi-info-circle-fill me-1" style="color:#f5a623;"></i>
                                <strong>Perhatian:</strong> Pilihan <em>Diambil Sendiri</em> mengharuskan pembayaran di muka. COD tidak tersedia untuk opsi ini.
                            </div>

                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-panel" data-aos="fade-up" data-aos-delay="100">
                        <div class="form-panel-header">
                            <h5><i class="bi bi-credit-card me-2" style="color:var(--nesa-primary);"></i>Metode Pembayaran</h5>
                        </div>
                        <div class="form-panel-body">

                            <label class="styled-label" style="margin-bottom:12px;">
                                Pilih metode yang ingin digunakan:
                            </label>

                            <div class="payment-method-group">
                                <label class="payment-card-label">
                                    <input type="radio" name="payment_method" value="transfer" id="pm-transfer" required>
                                    <div class="payment-card-inner">
                                        <div class="payment-card-icon">🏦</div>
                                        <div class="payment-card-name">Transfer Bank</div>
                                    </div>
                                </label>
                                <label class="payment-card-label" id="pm-cod-label">
                                    <input type="radio" name="payment_method" value="cod" id="pm-cod">
                                    <div class="payment-card-inner" id="pm-cod-inner">
                                        <div class="payment-card-icon">💵</div>
                                        <div class="payment-card-name">Cash (COD)</div>
                                        <div style="font-size:0.7rem;color:#aaa;" id="pm-cod-sub">Bayar saat diterima</div>
                                    </div>
                                </label>
                                <label class="payment-card-label">
                                    <input type="radio" name="payment_method" value="ewallet" id="pm-ewallet">
                                    <div class="payment-card-inner">
                                        <div class="payment-card-icon">📱</div>
                                        <div class="payment-card-name">E-Wallet</div>
                                    </div>
                                </label>
                            </div>

                            <!-- Hidden: note from cart -->
                            <input type="hidden" name="note" value="{{ session('checkout_note', request()->get('catatan')) }}">

                        </div>
                    </div>
                </form>
            </div>

            {{-- RIGHT: Order Summary --}}
            <div class="col-lg-5" data-aos="fade-left">
                <div class="summary-card">
                    <div class="summary-card-header">
                        <h5><i class="bi bi-receipt-cutoff me-2"></i>Ringkasan Pesanan</h5>
                    </div>
                    <div class="summary-card-body">

                        @php $grandTotal = 0; @endphp

                        @if(count($items) > 0)
                            @foreach($items as $item)
                                @php
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $grandTotal += $subtotal;
                                @endphp
                                <div class="order-item-line">
                                    <div class="order-item-left">
                                        {{ $item['name'] }}
                                        <small>{{ $item['quantity'] }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                                    </div>
                                    <div class="order-item-right">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p style="color:#aaa;font-size:0.9rem;text-align:center;padding:20px 0;">Keranjang belanja kosong.</p>
                        @endif

                        @if(session('checkout_note'))
                        <hr class="order-divider">
                        <div style="font-size:0.8rem;font-weight:600;color:#777;margin-bottom:6px;">
                            <i class="bi bi-pencil me-1"></i> Catatan:
                        </div>
                        <div class="order-note-box">
                            {{ session('checkout_note') }}
                        </div>
                        @endif

                        <hr class="order-divider">

                        <!-- Promo Preview -->
                        <div class="order-item-line" style="margin-bottom:8px;">
                            <span style="font-size:0.85rem;color:#888;">Kode Promo</span>
                            <span id="previewPromo" style="font-size:0.85rem;font-weight:700;color:var(--nesa-primary);">
                                {{ request()->get('promo') ? request()->get('promo') : '-' }}
                            </span>
                        </div>
                        <div class="order-item-line">
                            <span style="font-size:0.85rem;color:#888;">Ongkos Antar</span>
                            <span id="display-delivery-fee" style="font-size:0.85rem;font-weight:700;color:#27ae60;">Gratis</span>
                        </div>

                        <hr class="order-divider">

                        <!-- Grand Total -->
                        <div class="order-total-line">
                            <span class="order-total-label">Total Pembayaran</span>
                            <span class="order-total-amount" id="display-grand-total">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" form="checkout-form" class="btn-place-order">
                            <i class="bi bi-bag-check-fill"></i>
                            Buat Pesanan
                            <i class="bi bi-arrow-right"></i>
                        </button>

                        <!-- Back to Cart -->
                        <a href="{{ url('/cart') }}" class="back-to-cart-link">
                            <i class="bi bi-arrow-left-circle"></i>
                            Kembali ke Keranjang
                        </a>

                        <!-- Trust Badges -->
                        <div style="margin-top:20px;border-top:1px solid #f0f0f0;padding-top:16px;">
                            <div style="font-size:0.75rem;color:#bbb;text-align:center;margin-bottom:10px;">Transaksi Aman & Terjamin</div>
                            <div style="display:flex;gap:12px;justify-content:center;align-items:center;">
                                <div style="display:flex;align-items:center;gap:4px;font-size:0.78rem;color:#888;">
                                    <i class="bi bi-shield-fill-check" style="color:var(--nesa-primary);"></i> Aman
                                </div>
                                <div style="display:flex;align-items:center;gap:4px;font-size:0.78rem;color:#888;">
                                    <i class="bi bi-lock-fill" style="color:var(--nesa-primary);"></i> Terenkripsi
                                </div>
                                <div style="display:flex;align-items:center;gap:4px;font-size:0.78rem;color:#888;">
                                    <i class="bi bi-star-fill" style="color:var(--nesa-primary);"></i> Terpercaya
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Base subtotal from PHP
    const baseSubtotal = {{ $grandTotal }};
    const DELIVERY_FEE = 5000;

    // Elements
    const deliveryDiantar  = document.getElementById('delivery-diantar');
    const deliveryDiambil  = document.getElementById('delivery-diambil');
    const codLabel         = document.getElementById('pm-cod-label');
    const codInput         = document.getElementById('pm-cod');
    const restrictionNote  = document.getElementById('cod-restriction-note');
    const feeDisplay       = document.getElementById('display-delivery-fee');
    const totalDisplay     = document.getElementById('display-grand-total');
    const promoInput       = document.getElementById('promo_code');
    const promoPreview     = document.getElementById('previewPromo');

    function formatRupiah(n) {
        return 'Rp ' + n.toLocaleString('id-ID');
    }

    function updateSummary() {
        const isDiantar = deliveryDiantar && deliveryDiantar.checked;
        const fee = isDiantar ? DELIVERY_FEE : 0;
        const total = baseSubtotal + fee;

        // Update fee display
        if (feeDisplay) {
            if (fee === 0) {
                feeDisplay.textContent = 'Gratis';
                feeDisplay.style.color = '#27ae60';
            } else {
                feeDisplay.textContent = formatRupiah(fee);
                feeDisplay.style.color = 'var(--nesa-accent, #ff8c00)';
            }
        }

        // Update grand total display
        if (totalDisplay) {
            totalDisplay.textContent = formatRupiah(total);
        }

        // COD restriction: hide COD if 'diambil' selected
        if (!isDiantar) {
            // Pilihan diambil -> COD tidak boleh
            if (codLabel) {
                codLabel.style.opacity = '0.4';
                codLabel.style.pointerEvents = 'none';
                codLabel.title = 'COD tidak tersedia untuk Diambil Sendiri';
            }
            if (codInput && codInput.checked) {
                codInput.checked = false;
                // Auto-select transfer
                const pmTransfer = document.getElementById('pm-transfer');
                if (pmTransfer) pmTransfer.checked = true;
            }
            if (restrictionNote) restrictionNote.classList.remove('d-none');
        } else {
            // Pilihan diantar -> COD boleh
            if (codLabel) {
                codLabel.style.opacity = '1';
                codLabel.style.pointerEvents = '';
                codLabel.title = '';
            }
            if (restrictionNote) restrictionNote.classList.add('d-none');
        }
    }

    // Listen for delivery type changes
    if (deliveryDiantar) deliveryDiantar.addEventListener('change', updateSummary);
    if (deliveryDiambil) deliveryDiambil.addEventListener('change', updateSummary);

    // Promo code sync
    if (promoInput && promoPreview) {
        promoInput.addEventListener('input', function() {
            promoPreview.textContent = this.value.trim() || '-';
        });
    }

    // Init on load
    updateSummary();
});
</script>

@endsection
