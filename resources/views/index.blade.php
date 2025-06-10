@extends('layouts.app')
@section('title', 'Nesafood - Home')
@section('content')
        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header bg-light">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h5 class="mb-3 text-muted">Lezat, Cepat, dan Terjangkau</h5>
                        <h1 class="display-3 fw-bold text-primary mb-4">
                            <span id="typed-text"></span>
                        </h1>
                        <p class="lead text-secondary mb-4">Rasakan kelezatan masakan khas Indonesia yang selalu segar dan siap dipesan dengan mudah langsung dari genggamanmu.</p>
                        <a href="{{ url('/stand/1') }}" class="btn btn-primary btn-lg px-4 rounded-pill">Lihat Menu</a>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative shadow rounded" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded overflow-hidden">
                                    <img src="img/Ayam Geprek.jpg" class="img-fluid w-100 rounded" alt="Ayam Geprek">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2 mt-2">
                                        <h5 class="text-white mb-0">Ayam Geprek</h5>
                                    </div>
                                </div>
                                <div class="carousel-item rounded overflow-hidden">
                                    <img src="img/Ayam Teriyaki.jpg" class="img-fluid w-100 rounded" alt="Ayam Teriyaki">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2 mt-2">
                                        <h5 class="text-white mb-0">Ayam Teriyaki</h5>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

        <!-- Best Categories Start -->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Best Categories</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">All Menu</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 130px;">Food</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 130px;">Drinks</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 130px;">Snack</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach([
                                            ['title' => 'Ayam Geprek', 'img' => 'img/Ayam Geprek.jpg', 'price' => 'Rp 11.000'],
                                            ['title' => 'Ayam Teriyaki', 'img' => 'img/Ayam Teriyaki.jpg', 'price' => 'Rp 13.000'],
                                            ['title' => 'Nasi Campur', 'img' => 'img/Nasi Campur.jpg', 'price' => 'Rp 12.000'],
                                            ['title' => 'Gado-Gado', 'img' => 'img/Gado-Gado.jpg', 'price' => 'Rp 15.000'],
                                        ] as $item)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="card shadow-sm border-0 h-100 rounded-4 hover-shadow transition-all">
                                                    <div class="position-relative">
                                                        <img src="{{ asset($item['img']) }}" class="card-img-top rounded-top-4" alt="{{ $item['title'] }}">
                                                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-1 rounded-pill fs-6">Food</span>
                                                    </div>
                                                    <div class="card-body d-flex flex-column justify-content-between">
                                                        <h5 class="card-title fw-semibold">{{ $item['title'] }}</h5>
                                                        <p class="card-text text-muted small">Nikmati hidangan lezat yang menggugah selera dengan harga terjangkau.</p>
                                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                                            <span class="text-dark fs-5 fw-bold">{{ $item['price'] }}</span>
                                                            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                                <i class="fa fa-shopping-bag me-2"></i>Add to cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach([
                                            ['title' => 'Ayam Geprek', 'img' => 'img/Ayam Geprek.jpg', 'price' => 'Rp 11.000'],
                                            ['title' => 'Ayam Teriyaki', 'img' => 'img/Ayam Teriyaki.jpg', 'price' => 'Rp 13.000'],
                                            ['title' => 'Nasi Campur', 'img' => 'img/Nasi Campur.jpg', 'price' => 'Rp 12.000'],
                                            ['title' => 'Gado-Gado', 'img' => 'img/Gado-Gado.jpg', 'price' => 'Rp 15.000'],
                                        ] as $item)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="card shadow-sm border-0 h-100 rounded-4 hover-shadow transition-all">
                                                    <div class="position-relative">
                                                        <img src="{{ asset($item['img']) }}" class="card-img-top rounded-top-4" alt="{{ $item['title'] }}">
                                                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-1 rounded-pill fs-6">Food</span>
                                                    </div>
                                                    <div class="card-body d-flex flex-column justify-content-between">
                                                        <h5 class="card-title fw-semibold">{{ $item['title'] }}</h5>
                                                        <p class="card-text text-muted small">Nikmati hidangan lezat yang menggugah selera dengan harga terjangkau.</p>
                                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                                            <span class="text-dark fs-5 fw-bold">{{ $item['price'] }}</span>
                                                            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                                <i class="fa fa-shopping-bag me-2"></i>Add to cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach([
                                            ['title' => 'Ayam Geprek', 'img' => 'img/Ayam Geprek.jpg', 'price' => 'Rp 11.000'],
                                            ['title' => 'Ayam Teriyaki', 'img' => 'img/Ayam Teriyaki.jpg', 'price' => 'Rp 13.000'],
                                            ['title' => 'Nasi Campur', 'img' => 'img/Nasi Campur.jpg', 'price' => 'Rp 12.000'],
                                            ['title' => 'Gado-Gado', 'img' => 'img/Gado-Gado.jpg', 'price' => 'Rp 15.000'],
                                        ] as $item)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="card shadow-sm border-0 h-100 rounded-4 hover-shadow transition-all">
                                                    <div class="position-relative">
                                                        <img src="{{ asset($item['img']) }}" class="card-img-top rounded-top-4" alt="{{ $item['title'] }}">
                                                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-1 rounded-pill fs-6">Food</span>
                                                    </div>
                                                    <div class="card-body d-flex flex-column justify-content-between">
                                                        <h5 class="card-title fw-semibold">{{ $item['title'] }}</h5>
                                                        <p class="card-text text-muted small">Nikmati hidangan lezat yang menggugah selera dengan harga terjangkau.</p>
                                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                                            <span class="text-dark fs-5 fw-bold">{{ $item['price'] }}</span>
                                                            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                                <i class="fa fa-shopping-bag me-2"></i>Add to cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach([
                                            ['title' => 'Ayam Geprek', 'img' => 'img/Ayam Geprek.jpg', 'price' => 'Rp 11.000'],
                                            ['title' => 'Ayam Teriyaki', 'img' => 'img/Ayam Teriyaki.jpg', 'price' => 'Rp 13.000'],
                                            ['title' => 'Nasi Campur', 'img' => 'img/Nasi Campur.jpg', 'price' => 'Rp 12.000'],
                                            ['title' => 'Gado-Gado', 'img' => 'img/Gado-Gado.jpg', 'price' => 'Rp 15.000'],
                                        ] as $item)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="card shadow-sm border-0 h-100 rounded-4 hover-shadow transition-all">
                                                    <div class="position-relative">
                                                        <img src="{{ asset($item['img']) }}" class="card-img-top rounded-top-4" alt="{{ $item['title'] }}">
                                                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-1 rounded-pill fs-6">Food</span>
                                                    </div>
                                                    <div class="card-body d-flex flex-column justify-content-between">
                                                        <h5 class="card-title fw-semibold">{{ $item['title'] }}</h5>
                                                        <p class="card-text text-muted small">Nikmati hidangan lezat yang menggugah selera dengan harga terjangkau.</p>
                                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                                            <span class="text-dark fs-5 fw-bold">{{ $item['price'] }}</span>
                                                            <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                                <i class="fa fa-shopping-bag me-2"></i>Add to cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        <!-- Best Categories End -->

        <!-- Featurs Start -->
        <div class="container-fluid service py-5 bg-light">
            <div class="container py-5">
                <!-- Promo Section Header -->
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="fw-bold text-primary">Penawaran Spesial Minggu Ini!</h2>
                    <p class="text-muted mx-auto" style="max-width: 700px;">
                        Jangan lewatkan berbagai promo menarik untuk hidangan favoritmu. Dapatkan diskon, gratis ongkir, dan banyak kejutan lainnya hanya di NesaFood. Buruan sebelum kehabisan!
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="img/Gado-Gado copy.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Gado-Gado</h5>
                                        <h3 class="mb-0">20% OFF</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="img/Ayam Geprek.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Ayam Geprek</h5>
                                        <h3 class="mb-0">Free delivery</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="img/Ayam Teriyaki copy.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Ayam Teriyaki</h5>
                                        <h3 class="mb-0">10% OFF</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->

        <!-- Bestsaler Product Start -->
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold text-primary">Menu Terlaris Kami</h2>
                <p class="text-muted">Nikmati hidangan paling favorit yang telah dipilih oleh para pelanggan kami. Dijamin enak dan memuaskan!</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                @foreach ($bestsellers as $index => $item)
                <div class="col-md-6 col-xl-4" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="p-4 rounded-4 bg-white shadow-sm h-100">
                        <div class="row align-items-center g-0">
                            <div class="col-5 text-center">
                                <!-- @php
                                    $image = trim($item->name) . '.jpg';
                                @endphp -->
                                @php
                                    $image = 'Ayam Bakar.jpg';
                                @endphp
                                <!-- <pre>{{ $item->name }}</pre> -->
                                <img src="{{ asset('img/' . rawurlencode($image)) }}" alt="{{ $item->name }}" class="img-fluid rounded-circle w-100">
                            </div>
                            <div class="col-7 ps-3">
                                <h5 class="fw-semibold mb-1">{{ $item->name }}</h5>
                                <div class="d-flex align-items-center mb-2">
                                    @for ($i = 0; $i < 4; $i++)
                                        <i class="fas fa-star text-warning me-1"></i>
                                    @endfor
                                    <i class="fas fa-star text-secondary"></i>
                                </div>
                                <h6 class="text-primary fw-bold mb-3">Rp {{ number_format($item->price, 0, ',', '.') }}</h6>
                                <a href="#"
                                class="btn btn-outline-primary btn-sm rounded-pill px-3 btn-add-to-cart"
                                data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                data-price="{{ $item->price }}"
                                data-image="{{ asset('img/' . rawurlencode($image)) }}">
                                    <i class="fa fa-shopping-bag me-2"></i>Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Bestsaler Product End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    <!-- JavaScript Libraries -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <script>
    AOS.init();
    </script>

    <script>
        var typed = new Typed('#typed-text', {
            strings: [
                "Nikmati Hidangan Favoritmu",
                "Kapan Saja, Di Mana Saja!"
            ],
            typeSpeed: 60,
            backSpeed: 30,
            backDelay: 1500,
            startDelay: 500,
            loop: true,
            showCursor: true,
            cursorChar: "|"
        });
    </script>

    <script>
        const isLoggedIn = @json(Auth::check());

        $(document).ready(function () {
            // Stand Detail Loader
            $('#standDropdown .dropdown-item').on('click', function(e) {
                e.preventDefault();
                var standId = $(this).data('stand-id');
                loadStandDetail(standId);
            });

            function loadStandDetail(standId) {
                $('#standDetail').html('<p>Loading details for Stand ' + standId + '...</p>');
                $.ajax({
                    url: '/standdetail/' + standId,
                    method: 'GET',
                    success: function(data) {
                        $('#standDetail').html(data);
                    },
                    error: function() {
                        $('#standDetail').html('<p>Error loading stand details.</p>');
                    }
                });
            }

            // Add to Cart (hindari multiple binding)
            $(document).off('click', '.btn-add-to-cart').on('click', '.btn-add-to-cart', function (e) {
                e.preventDefault();

                if (!isLoggedIn) {
                    alert("Silakan login terlebih dahulu untuk menambahkan ke keranjang.");
                    window.location.href = "/auth/login";
                    return;
                }

                const menuId = $(this).data('id');
                const menuName = $(this).data('name');
                const menuPrice = $(this).data('price');
                const menuImage = $(this).data('image');

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: menuId,
                        name: menuName,
                        price: menuPrice,
                        image: menuImage
                    },
                    success: function (response) {
                        alert(response.message);
                        $('.cart-count').text(response.cartCount);
                    },
                    error: function (xhr) {
                        alert("Gagal menambahkan ke keranjang.");
                    }
                });
            });
        });
    </script>




@endsection
