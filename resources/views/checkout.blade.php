<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NesaFood - Checkout</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Link styles and scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Navbar Start -->
    <div class="container-fluid fixed-top">
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <h1 class="text-primary display-6">NesaFood</h1>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ url('/stand') }}" class="nav-item nav-link">Stand</a>

                            <!-- Dropdown Stand Detail -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" id="standDetailDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Stand Detail
                                </a>
                                <div class="dropdown-menu" aria-labelledby="standDetailDropdown" style="max-height: 300px; overflow-y: auto;">
                                    @for($i = 1; $i <= 20; $i++)
                                        <a class="dropdown-item" href="{{ route('stand.show', $i) }}">Stand {{ $i }}</a>
                                    @endfor
                                </div>
                            </div>

                            <a href="{{ url('/aboutus') }}" class="nav-item nav-link">About Us</a>
                            </div>

                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="fas fa-search text-primary"></i>
                            </button>
                            <a href="{{ url('/cart') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
                            <a href="{{ url('/profile') }}" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
    </div>
    <!-- Navbar End -->

    <div class="container mt-5 pt-5" style="max-width: 600px;">

        <!-- Menu Pesanan -->
        <h4>Menu Pesanan</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Harga -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Total Pembayaran: </h4>
            <h4 class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</h4>
        </div>

        <!-- Alamat Pengiriman -->
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Pengiriman</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat pengiriman" required>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-3">
            <label for="payment_method" class="form-label">Pilih Metode Pembayaran</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="qris">Qris</option>
                <option value="debit">Debit</option>
                <option value="kredit">Kredit</option>
                <option value="cash">Cash</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <!-- Catatan Pembeli -->
        <div class="mb-3">
            <label for="note" class="form-label">Catatan Pembeli</label>
            <textarea class="form-control" id="note" name="note" rows="3" placeholder="Masukkan catatan (opsional)"></textarea>
        </div>

        <!-- Kode Promo atau Voucher -->
        <div class="mb-3">
            <label for="promo_code" class="form-label">Masukkan Kode Promo atau Voucher</label>
            <input type="text" class="form-control" id="promo_code" name="promo_code" placeholder="Masukkan kode promo atau voucher (opsional)">
        </div>

        <!-- Tombol Pesan (Tengah dan Panjang) -->
        <div class="text-center">
            <button class="btn btn-primary w-100" id="orderButton">Pesan</button>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Mengatur pengiriman form menggunakan AJAX untuk checkout
        $("#orderButton").click(function () {
            let address = $("#address").val();
            let payment_method = $("#payment_method").val();
            let note = $("#note").val();
            let promo_code = $("#promo_code").val();

            $.ajax({
                url: "{{ route('cart.processCheckout') }}",
                method: "POST",
                data: {
                    address: address,
                    payment_method: payment_method,
                    note: note,
                    promo_code: promo_code
                },
                success: function(response) {
                    if(response.success) {
                        window.location.href = "{{ url('/orderhistory') }}";  // Redirect ke halaman riwayat pesanan
                    } else {
                        alert("Gagal memproses pesanan. Silakan coba lagi.");
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
