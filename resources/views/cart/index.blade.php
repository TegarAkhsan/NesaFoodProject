<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NesaFood - Keranjang Belanja</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

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

    <div class="container" style="margin-top: 100px;">
        <!-- <h2 class="mb-4">Keranjang Belanja</h2> -->
        @if(count($items) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-secondary btn-update me-1" data-id="{{ $item['id'] }}" data-type="decrease">−</button>
                                    <span class="mx-2">{{ $item['quantity'] }}</span>
                                    <button class="btn btn-sm btn-secondary btn-update ms-1" data-id="{{ $item['id'] }}" data-type="increase">+</button>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger btn-remove" data-id="{{ $item['id'] }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol Checkout -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger">Kosongkan Keranjang</a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Checkout</a>  <!-- Perbaikan pada link -->
            </div>
        @else
            <p class="text-muted">Keranjang Anda masih kosong.</p>
        @endif
    </div>

    <!-- Scripts -->
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $(".btn-update").click(function () {
            let id = $(this).data('id');
            let type = $(this).data('type');

            $.post("{{ route('cart.update') }}", { id, type }, function (response) {
                if (response.success) location.reload();
            });
        });

        $(".btn-remove").click(function () {
            let id = $(this).data('id');

            $.post("{{ route('cart.remove', '') }}/" + id, function (response) {
                if (response.success) location.reload();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
