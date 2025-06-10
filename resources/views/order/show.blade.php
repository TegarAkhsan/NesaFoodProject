<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>NesaFood</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
    @include('layouts.navigation')
    <!-- Order Detail Section with QR and Countdown -->
    <div class="container" style="margin-top: 150px; padding-left: 20px; padding-right: 20px;">
        <div class="row shadow rounded-4 p-4 bg-white">
            <!-- Left: Order Details -->
            <div class="col-md-8">
                <h2 class="h4 fw-bold text-warning mb-4">Detail Pesanan #{{ $order->id }}</h2>

                <ul class="list-unstyled text-muted">
                    <li><strong>Nama:</strong> {{ $order->name }}</li>
                    <li><strong>Alamat:</strong> {{ $order->address }}</li>
                    <li><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</li>
                    @if($order->promo_code)
                        <li><strong>Promo:</strong> <span class="text-success">{{ $order->promo_code }}</span></li>
                    @endif
                    @if($order->note)
                        <li><strong>Catatan:</strong> {{ $order->note }}</li>
                    @endif
                    <li>
                        <strong>Status:</strong>
                        <span class="badge 
                            {{ $order->status === 'pending' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </li>
                </ul>

                <hr class="my-4">

                <h5 class="fw-semibold text-secondary mb-3">Item Pesanan:</h5>
                <ul class="list-group mb-4">
                    @foreach ($order->orderItems as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                {{ $item->name }} 
                                <small class="text-muted">({{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }})</small>
                            </div>
                            <div class="fw-medium">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-3">
                    <span>Total:</span>
                    <span>Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Right: QR and Payment Summary -->
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body bg-light rounded">
                        <h5 class="card-title text-center text-warning">Informasi Pembayaran</h5>
                        
                        <div class="text-center my-3">
                            <p class="mb-2">Scan QR untuk bayar:</p>
                            <div>{!! $qrCode !!}</div>
                            <p><strong>Kode Invoice:</strong> {{ $order->invoice_code }}</p>
                        </div>

                        <ul class="list-unstyled text-muted">
                            <li><strong>Metode:</strong> {{ ucfirst($order->payment_method) }}</li>
                            <li><strong>Total Bayar:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</li>
                            <li><strong>Kode Invoice:</strong> {{ $order->invoice_code }}</li>
                        </ul>

                        <div class="alert alert-warning text-center py-2 mt-3">
                            <div>Selesaikan pembayaran dalam:</div>
                            <div id="countdown" class="fw-bold fs-5 mt-1">--:--</div>
                        </div>

                        @if ($order->status !== 'paid')
                            <form action="{{ route('index') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="mb-3">
                                    <input type="text" name="invoice_code" class="form-control" placeholder="Masukkan Kode Invoice">
                                </div>
                                <button type="submit" class="btn btn-warning w-100 text-white">
                                    Konfirmasi Pembayaran
                                </button>
                            </form>
                        @else
                            <div class="alert alert-success text-center mt-3">
                                Pembayaran sudah dikonfirmasi.
                            </div>
                        @endif

                        <!-- {{-- Tampilkan pesan sukses jika ada --}}
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        const orderStatus = "{{ $order->status }}";
        const countdownEl = document.getElementById('countdown');

        if (orderStatus === 'paid') {
            countdownEl.innerHTML = 'Telah Dibayar';
            countdownEl.classList.remove('text-danger');
            countdownEl.classList.add('text-success');
        } else {
            const createdAt = new Date("{{ $order->created_at->format('Y-m-d\TH:i:s') }}");
            const deadline = new Date(createdAt.getTime() + 60 * 60 * 1000); // 1 jam dari created_at

            function updateCountdown() {
                const now = new Date();
                const diff = Math.floor((deadline - now) / 1000); // detik

                if (diff <= 0) {
                    countdownEl.innerHTML = 'Waktu habis';
                    countdownEl.classList.add('text-danger');
                    clearInterval(timer);
                } else {
                    const m = Math.floor(diff / 60);
                    const s = diff % 60;
                    countdownEl.innerHTML = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
                }
            }

            updateCountdown();
            const timer = setInterval(updateCountdown, 1000);
        }
    </script>


</body>

</html>
