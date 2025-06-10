<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NesaFood - {{ $stand->name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    @include('layouts.navigation')

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

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $stand->name }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/stand') }}">Stand</a></li>
            <li class="breadcrumb-item active text-white">{{ $stand->name }}</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div id="standDetailContent">
                        <div class="text-center mb-5">
                            <h4 class="fw-bold mb-3">{{ $stand->name }}</h4>
                            <p class="mb-3">{{ $stand->description }}</p>
                        </div>
                        <div class="tab-class text-center">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-food">
                                        <span class="text-dark" style="width: 130px;">Food</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-drink">
                                        <span class="text-dark" style="width: 130px;">Drink</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-snack">
                                        <span class="text-dark" style="width: 130px;">Snack</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-food" class="tab-pane fade show p-0 active">
                                    @if(isset($foods) && count($foods) > 0)
                                        <div class="row g-4">
                                            @foreach($foods as $food => $item)
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="position-relative rounded-top overflow-hidden" style="height: 250px; overflow: hidden;">
                                                        @php
                                                            $image = 'Ayam Bakar.jpg';
                                                        @endphp
                                                        <img src="{{ asset('img/' . rawurlencode($image)) }}" 
                                                            alt="{{ $item->name }}" 
                                                            class="w-100 h-100" 
                                                            style="object-fit: cover;">
                                                    </div>

                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Food</div>

                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column h-100">
                                                        <h4 class="mb-2">{{ $item->name }}</h4>
                                                        <p class="mb-3 flex-grow-1">{{ $item->description }}</p>

                                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart"
                                                            data-id="{{ $item->id }}"
                                                            data-name="{{ $item->name }}"
                                                            data-price="{{ $item->price }}"
                                                            data-image="{{ asset('img/' . rawurlencode($image)) }}">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-center text-muted">No food items available.</p>
                                    @endif
                                </div>
                                
                                <div id="tab-drink" class="tab-pane fade show p-0">
                                    <div class="row g-4">
                                        @foreach($drinks as $drink)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item h-100">
                                                <div class="fruite-img">
                                                    <img src="{{ asset($drink->image) }}" class="img-fluid w-100 rounded-top" style="height: 200px; object-fit: cover;" alt="{{ $drink->name }}">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Drink</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column h-100">
                                                    <h4 class="mb-2">{{ $drink->name }}</h4>
                                                    <p class="mb-3 flex-grow-1">{{ $drink->description }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap align-items-center">
                                                        <p class="text-dark fs-5 fw-bold mb-0">Rp {{ number_format($drink->price, 0, ',', '.') }}</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart"
                                                        data-id="{{ $drink->id }}"
                                                        data-name="{{ $drink->name }}"
                                                        data-price="{{ $drink->price }}"
                                                        data-image="{{ asset($drink->image) }}">
                                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
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
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Makanan</a>
                                            <span>({{ count($foods) }})</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-glass-whiskey me-2"></i>Minuman</a>
                                            <span>({{ count($drinks) }})</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-4">Featured products</h4>
                            @if(count($foods) > 0 && isset($foods[0]))
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('img/menus/' . $foods[0]->image) }}" class="img-fluid rounded" alt="{{ $foods[0]->name }}">
                                </div>
                                <div>
                                    <h6 class="mb-2">{{ $foods[0]->name }}</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">Rp {{ number_format($foods[0]->price, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                            @else
                            <p class="text-muted">No featured food available.</p>
                            @endif

                            @if(count($drinks) > 0 && isset($drinks[0]))
                            <div class="d-flex align-items-center justify-content-start mt-3">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('img/menus/' . $drinks[0]->image) }}" class="img-fluid rounded" alt="{{ $drinks[0]->name }}">
                                </div>
                                <div>
                                    <h6 class="mb-2">{{ $drinks[0]->name }}</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">Rp {{ number_format($drinks[0]->price, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                            @else
                            <p class="text-muted">No featured drink available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

    @include('layouts.footer')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Custom JavaScript untuk halaman ini -->
    <script>
        $(document).ready(function() {
            // AJAX untuk dropdown stand detail
            $('#standDropdown .dropdown-item').on('click', function(e) {
                e.preventDefault();
                var standId = $(this).data('stand-id');
                window.location.href = '/standdetail/' + standId;
            });

            // AJAX untuk add to cart
            $('.btn-add-to-cart').on('click', function(e) {
                e.preventDefault();
                
                var menuId = $(this).data('id');
                var menuName = $(this).data('name');
                var menuPrice = $(this).data('price');
                var menuImage = $(this).data('image');

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
                    success: function(response) {
                        alert(response.message);
                        // Update cart count
                        $('.cart-count').text(response.cartCount);
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>