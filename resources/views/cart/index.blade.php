<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stand Detail</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
</head>
<body>
        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

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
                                        <a class="dropdown-item" href="{{ url('/standdetail/' . $i) }}">Stand {{ $i }}</a>
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

    @foreach($items as $item)
        <div class="product">
            <h3>{{ $item['name'] }}</h3>
            <p>Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
            <form class="cart-form">
                @csrf
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <input type="hidden" name="name" value="{{ $item['name'] }}">
                <input type="hidden" name="price" value="{{ $item['price'] }}">
                <button type="button" class="btn-add-to-cart">Add to Cart</button>
            </form>
        </div>
    @endforeach

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-add-to-cart").click(function () {
            let form = $(this).closest(".cart-form");
            let formData = form.serialize();

            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    console.log("Response dari server:", response); // Debugging
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert("Terjadi kesalahan saat menambahkan item.");
                    }
                },
                error: function (error) {
                    console.log("Error:", error);
                    alert("Terjadi kesalahan, coba lagi.");
                }
            });
        });
    </script>
</body>
</html>