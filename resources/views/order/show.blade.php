@extends('layouts.app')
@section('title', 'NesaFood - Detail Pesanan #{{ $order->id }}')
@section('content')

<style>
    /* =============================================
       ORDER DETAIL PAGE STYLES
    ============================================= */
    .order-page-wrapper {
        min-height: 100vh;
        background: linear-gradient(160deg, #f0f7eb 0%, #f9f9f9 60%, #fff 100%);
        padding-top: 100px;
        padding-bottom: 60px;
    }

    /* ---- Breadcrumb ---- */
    .order-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: #aaa;
        margin-bottom: 20px;
    }

    .order-breadcrumb a {
        color: var(--nesa-primary);
        text-decoration: none;
        font-weight: 600;
    }

    /* ---- Success Banner ---- */
    .success-banner {
        background: linear-gradient(135deg, #1b4332, #27643f);
        border-radius: 20px;
        padding: 24px 28px;
        color: #fff;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .success-icon {
        width: 56px;
        height: 56px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
    }

    .success-banner h4 {
        font-weight: 800;
        margin: 0 0 4px;
        font-size: 1.15rem;
    }

    .success-banner p {
        margin: 0;
        font-size: 0.88rem;
        opacity: 0.8;
    }

    /* ---- Order Info Panel ---- */
    .order-panel {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(27, 67, 50, 0.07);
        border: 1px solid rgba(129, 196, 8, 0.12);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .order-panel-header {
        padding: 16px 24px;
        background: linear-gradient(90deg, #f0f7eb, #fff);
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .order-panel-header h5 {
        font-weight: 700;
        color: #1b4332;
        font-size: 1rem;
        margin: 0;
    }

    .order-panel-body {
        padding: 20px 24px;
    }

    /* ---- Info Rows ---- */
    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f8f8f8;
        font-size: 0.9rem;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #888;
        min-width: 140px;
        flex-shrink: 0;
    }

    .info-value {
        color: #333;
        flex: 1;
    }

    /* ---- Status Badge ---- */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-badge.paid {
        background: #d1e7dd;
        color: #0a3622;
    }

    .status-badge.cancelled {
        background: #f8d7da;
        color: #58151c;
    }

    /* ---- Delivery Badge ---- */
    .delivery-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .delivery-badge.diantar {
        background: #fff3cd;
        color: #7c5a00;
    }

    .delivery-badge.diambil {
        background: #e0f2f1;
        color: #004d40;
    }

    /* ---- Item List ---- */
    .order-item-entry {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
        font-size: 0.9rem;
    }

    .order-item-entry:last-child {
        border-bottom: none;
    }

    .order-item-icon {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #eaf5d3, #d5edb0);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .order-item-name {
        font-weight: 600;
        color: #1b4332;
        flex: 1;
    }

    .order-item-qty {
        font-size: 0.8rem;
        color: #888;
    }

    .order-item-price {
        font-weight: 700;
        color: #333;
        white-space: nowrap;
    }

    /* ---- Total Row ---- */
    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 0.9rem;
    }

    .total-row.grand {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1b4332;
        border-top: 2px solid #f0f0f0;
        margin-top: 4px;
        padding-top: 14px;
    }

    .total-row.grand .amount {
        color: var(--nesa-primary);
    }

    /* ---- Payment Panel ---- */
    .payment-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(27, 67, 50, 0.07);
        border: 1px solid rgba(129, 196, 8, 0.12);
        overflow: hidden;
        position: sticky;
        top: 100px;
    }

    .payment-card-header {
        padding: 16px 24px;
        background: linear-gradient(135deg, #1b4332, #27643f);
        border-bottom: none;
    }

    .payment-card-header h5 {
        font-weight: 700;
        color: #fff;
        margin: 0;
        font-size: 1rem;
    }

    .payment-card-body {
        padding: 24px;
    }

    /* ---- QR Container ---- */
    .qr-container {
        text-align: center;
        padding: 20px;
        background: #f9fdf4;
        border-radius: 14px;
        border: 1px dashed rgba(129, 196, 8, 0.4);
        margin-bottom: 16px;
    }

    .qr-container p {
        font-size: 0.82rem;
        color: #888;
        margin-bottom: 10px;
    }

    .qr-container .invoice-code {
        font-size: 0.8rem;
        font-weight: 700;
        color: #1b4332;
        margin-top: 10px;
        letter-spacing: 0.5px;
        word-break: break-all;
    }

    /* ---- COD Info Box ---- */
    .cod-info-box {
        text-align: center;
        padding: 24px 20px;
        background: #fffbf0;
        border-radius: 14px;
        border: 1px dashed #ffe082;
        margin-bottom: 16px;
    }

    .cod-info-box .cod-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .cod-info-box h6 {
        font-weight: 800;
        color: #7c5a00;
        margin-bottom: 6px;
    }

    .cod-info-box p {
        font-size: 0.83rem;
        color: #999;
        margin: 0;
    }

    /* ---- Payment Summary Lines ---- */
    .pay-summary-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.88rem;
        padding: 6px 0;
        color: #666;
    }

    .pay-summary-line.grand {
        font-weight: 800;
        color: #1b4332;
        font-size: 1rem;
        border-top: 1px solid #f0f0f0;
        padding-top: 12px;
        margin-top: 4px;
    }

    .pay-summary-line.grand .amount {
        color: var(--nesa-primary);
        font-size: 1.2rem;
    }

    /* ---- Countdown ---- */
    .countdown-box {
        background: linear-gradient(135deg, #fff8e1, #fff3cd);
        border: 1px solid #ffe082;
        border-radius: 12px;
        padding: 14px;
        text-align: center;
        margin-top: 14px;
    }

    .countdown-label {
        font-size: 0.8rem;
        color: #7c5a00;
        margin-bottom: 4px;
    }

    .countdown-timer {
        font-size: 1.6rem;
        font-weight: 900;
        color: #e65100;
        font-variant-numeric: tabular-nums;
    }

    /* ---- Confirm Form ---- */
    .confirm-form-input {
        width: 100%;
        border: 1.5px solid #e5e5e5;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.2s;
        margin-bottom: 10px;
    }

    .confirm-form-input:focus {
        border-color: var(--nesa-primary);
        box-shadow: 0 0 0 3px rgba(129, 196, 8, 0.12);
    }

    .btn-confirm-pay {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 13px;
        background: linear-gradient(135deg, #81c408, #6ea406);
        color: #fff;
        font-weight: 800;
        font-size: 0.95rem;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 16px rgba(129, 196, 8, 0.3);
    }

    .btn-confirm-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(129, 196, 8, 0.45);
    }

    .paid-confirmed-box {
        background: #d1e7dd;
        border-radius: 12px;
        padding: 14px;
        text-align: center;
        color: #0a3622;
        font-weight: 700;
        font-size: 0.92rem;
    }
</style>

<div class="order-page-wrapper">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="order-breadcrumb">
            <a href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i> Beranda</a>
            <i class="bi bi-chevron-right" style="font-size:0.7rem;"></i>
            <span>Pesanan #{{ $order->id }}</span>
        </div>

        <!-- Success Banner -->
        <div class="success-banner" data-aos="fade-down">
            <div class="success-icon">
                @if($order->status === 'paid')
                    ✅
                @else
                    🎉
                @endif
            </div>
            <div>
                <h4>
                    @if($order->status === 'paid')
                        Pembayaran Berhasil Dikonfirmasi!
                    @else
                        Pesanan Berhasil Dibuat!
                    @endif
                </h4>
                <p>
                    @if($order->status === 'paid')
                        Pesanan Anda sedang diproses. Kode invoice: <strong>{{ $order->invoice_code }}</strong>
                    @else
                        Pesanan Anda sedang menunggu pembayaran. Kode invoice: <strong>{{ $order->invoice_code }}</strong>
                    @endif
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4 align-items-start">

            {{-- LEFT: Order Details --}}
            <div class="col-lg-7">

                <!-- Order Info -->
                <div class="order-panel" data-aos="fade-up">
                    <div class="order-panel-header">
                        <h5><i class="bi bi-receipt me-2" style="color:var(--nesa-primary);"></i>Informasi Pesanan</h5>
                        <span class="status-badge {{ $order->status }}">
                            @if($order->status === 'paid')
                                <i class="bi bi-check-circle-fill"></i> Lunas
                            @elseif($order->status === 'cancelled')
                                <i class="bi bi-x-circle-fill"></i> Dibatalkan
                            @else
                                <i class="bi bi-clock-fill"></i> Menunggu
                            @endif
                        </span>
                    </div>
                    <div class="order-panel-body">
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-hash me-1"></i>No. Pesanan</span>
                            <span class="info-value">#{{ $order->id }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-person me-1"></i>Nama</span>
                            <span class="info-value">{{ $order->customer_name ?? $order->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-geo-alt me-1"></i>Alamat / Meja</span>
                            <span class="info-value">{{ $order->address ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-truck me-1"></i>Cara Terima</span>
                            <span class="info-value">
                                @if(($order->delivery_type ?? 'diambil') === 'diantar')
                                    <span class="delivery-badge diantar">🛵 Diantar</span>
                                @else
                                    <span class="delivery-badge diambil">🛍️ Diambil Sendiri</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-credit-card me-1"></i>Metode Bayar</span>
                            <span class="info-value">
                                @if($order->payment_method === 'transfer')
                                    🏦 Transfer Bank
                                @elseif($order->payment_method === 'cod')
                                    💵 Cash (COD)
                                @elseif($order->payment_method === 'ewallet')
                                    📱 E-Wallet
                                @else
                                    {{ ucfirst($order->payment_method) }}
                                @endif
                            </span>
                        </div>
                        @if($order->promo_code)
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-tag me-1"></i>Kode Promo</span>
                            <span class="info-value" style="color:var(--nesa-primary);font-weight:700;">{{ $order->promo_code }}</span>
                        </div>
                        @endif
                        @if($order->note)
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-pencil me-1"></i>Catatan</span>
                            <span class="info-value" style="font-style:italic;color:#666;">{{ $order->note }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Order Items -->
                <div class="order-panel" data-aos="fade-up" data-aos-delay="80">
                    <div class="order-panel-header">
                        <h5><i class="bi bi-bag me-2" style="color:var(--nesa-primary);"></i>Item Pesanan</h5>
                    </div>
                    <div class="order-panel-body">
                        @php $subtotal = 0; @endphp
                        @foreach($order->orderItems as $item)
                            @php $subtotal += $item->price * $item->quantity; @endphp
                            <div class="order-item-entry">
                                <div class="order-item-icon">🍽️</div>
                                <div class="order-item-name">
                                    {{ $item->name ?? ($item->menu->name ?? '-') }}
                                    <div class="order-item-qty">{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                </div>
                                <div class="order-item-price">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach

                        <!-- Breakdown Total -->
                        <div style="margin-top:16px;">
                            <div class="total-row">
                                <span style="color:#888;">Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            @php $deliveryFee = $order->delivery_fee ?? 0; @endphp
                            @if($deliveryFee > 0)
                            <div class="total-row">
                                <span style="color:#888;">Ongkos Antar</span>
                                <span style="color:#ff8c00;">+ Rp {{ number_format($deliveryFee, 0, ',', '.') }}</span>
                            </div>
                            @else
                            <div class="total-row">
                                <span style="color:#888;">Ongkos Antar</span>
                                <span style="color:#27ae60;">Gratis</span>
                            </div>
                            @endif
                            <div class="total-row grand">
                                <span>Total Pembayaran</span>
                                <span class="amount">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT: Payment Info --}}
            <div class="col-lg-5" data-aos="fade-left">
                <div class="payment-card">
                    <div class="payment-card-header">
                        <h5><i class="bi bi-shield-check me-2"></i>Informasi Pembayaran</h5>
                    </div>
                    <div class="payment-card-body">

                        @if($order->payment_method === 'cod')
                            {{-- COD: Tidak ada QR, cukup instruksi bayar langsung --}}
                            <div class="cod-info-box">
                                <div class="cod-icon">💵</div>
                                <h6>Bayar Langsung ke Kasir</h6>
                                <p>Tunjukkan nomor pesanan ini kepada penjual saat mengambil atau menerima pesanan.</p>
                            </div>

                            <div class="pay-summary-line">
                                <span>No. Pesanan</span>
                                <span style="font-weight:700;color:#1b4332;">#{{ $order->id }}</span>
                            </div>
                            <div class="pay-summary-line">
                                <span>Metode</span>
                                <span style="font-weight:700;">💵 Cash (COD)</span>
                            </div>
                            <div class="pay-summary-line">
                                <span>Cara Terima</span>
                                <span style="font-weight:700;">
                                    @if(($order->delivery_type ?? 'diambil') === 'diantar') 🛵 Diantar @else 🛍️ Diambil @endif
                                </span>
                            </div>
                            <div class="pay-summary-line grand">
                                <span>Total Bayar</span>
                                <span class="amount">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>

                            @if($order->status === 'paid')
                                <div class="paid-confirmed-box mt-4">
                                    <i class="bi bi-check-circle-fill me-1"></i> Pembayaran telah dikonfirmasi
                                </div>
                            @else
                                <div style="margin-top:16px;padding:12px 14px;background:#f9fdf4;border-radius:12px;border:1px solid #e0f0c0;font-size:0.8rem;color:#666;">
                                    <i class="bi bi-info-circle-fill me-1" style="color:var(--nesa-primary);"></i>
                                    Status pesanan akan diperbarui setelah kasir mengkonfirmasi pembayaran Anda.
                                </div>
                            @endif

                        @else
                            {{-- Transfer / E-Wallet: Tampilkan QR Code --}}
                            <div class="qr-container">
                                <p>Scan QR Code untuk membayar:</p>
                                <div>{!! $qrCode !!}</div>
                                <div class="invoice-code">{{ $order->invoice_code }}</div>
                            </div>

                            <div class="pay-summary-line">
                                <span>Metode</span>
                                <span style="font-weight:700;">
                                    @if($order->payment_method === 'transfer') 🏦 Transfer Bank
                                    @else 📱 E-Wallet @endif
                                </span>
                            </div>
                            <div class="pay-summary-line">
                                <span>Cara Terima</span>
                                <span style="font-weight:700;">
                                    @if(($order->delivery_type ?? 'diambil') === 'diantar') 🛵 Diantar @else 🛍️ Diambil @endif
                                </span>
                            </div>
                            <div class="pay-summary-line">
                                <span>Kode Invoice</span>
                                <span style="font-weight:700;font-size:0.8rem;color:#1b4332;">{{ $order->invoice_code }}</span>
                            </div>
                            <div class="pay-summary-line grand">
                                <span>Total Bayar</span>
                                <span class="amount">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>

                            {{-- Countdown hanya jika belum paid --}}
                            @if($order->status !== 'paid')
                                <div class="countdown-box">
                                    <div class="countdown-label">Selesaikan pembayaran dalam:</div>
                                    <div class="countdown-timer" id="countdown">--:--</div>
                                </div>

                                <form action="{{ route('index') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="text" name="invoice_code" class="confirm-form-input"
                                        placeholder="Masukkan Kode Invoice">
                                    <button type="submit" class="btn-confirm-pay">
                                        <i class="bi bi-patch-check-fill"></i>
                                        Konfirmasi Pembayaran
                                    </button>
                                </form>
                            @else
                                <div class="paid-confirmed-box mt-4">
                                    <i class="bi bi-check-circle-fill me-1"></i> Pembayaran telah dikonfirmasi
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
@if($order->payment_method !== 'cod' && $order->status !== 'paid')
    const countdownEl = document.getElementById('countdown');
    if (countdownEl) {
        const createdAt = new Date("{{ $order->created_at->format('Y-m-d\TH:i:s') }}");
        const deadline  = new Date(createdAt.getTime() + 60 * 60 * 1000); // 1 jam

        function updateCountdown() {
            const now  = new Date();
            const diff = Math.floor((deadline - now) / 1000);

            if (diff <= 0) {
                countdownEl.innerHTML = 'Waktu habis';
                countdownEl.style.color = '#e53935';
                clearInterval(timer);
            } else {
                const m = Math.floor(diff / 60);
                const s = diff % 60;
                countdownEl.innerHTML = `${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
            }
        }

        updateCountdown();
        const timer = setInterval(updateCountdown, 1000);
    }
@elseif($order->payment_method !== 'cod' && $order->status === 'paid')
    const countdownEl = document.getElementById('countdown');
    if (countdownEl) {
        countdownEl.innerHTML = 'Telah Dibayar';
        countdownEl.style.color = '#27ae60';
    }
@endif
</script>

@endsection
