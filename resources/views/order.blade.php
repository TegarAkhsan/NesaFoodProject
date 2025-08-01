<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NesaFood - Keranjang Belanja</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
                        <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
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

    <div class="container py-5" style="margin-top:80px;">
        <h2>Detail Pesanan #{{ $order->id }}</h2>

        <div class="card p-4 rounded shadow-sm">
            <p><strong>Nama Pelanggan:</strong> {{ $order->customer_name }}</p>
            <p><strong>Alamat:</strong> {{ $order->address ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Kode Promo:</strong> {{ $order->promo_code ?? '-' }}</p>
            <p><strong>Catatan:</strong> {{ $order->note ?? 'Tidak ada catatan.' }}</p>

            <h4 class="mt-4">Item Pesanan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->menu->name ?? $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-4 align-items-center">
                <h5>Total Harga: Rp {{ number_format($order->total_price, 0, ',', '.') }}</h5>
                <button class="btn btn-success" disabled>Selesai</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
