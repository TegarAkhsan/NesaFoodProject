<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NesaFood - Stand 1</title>
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
                            <a href="#" class="nav-link dropdown-toggle active" id="standDetailDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Stand Detail
                            </a>
                            <div class="dropdown-menu" aria-labelledby="standDetailDropdown" style="max-height: 300px; overflow-y: auto;" id="standDropdown">
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
                        <a href="{{ url('/checkout') }}" class="position-relative me-4 my-auto">
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
        <h1 class="text-center text-white display-6">Stand 1 - Mak Limat Biadab</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Stand 1</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div id="standDetail">
                        <div class="text-center mb-5">
                            <h4 class="fw-bold mb-3">Stand 1 - Mak Limat Biadab</h4>
                            <p class="mb-3">Stand 1 Muantep poll lee, Ubur-Ubur ikan lele, gwendeng lee</p>
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
                                    <div id="foodCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="row g-4 justify-content-center">
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="{{ asset('img/stand/Stand 5.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Foods</div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>Ayam Teriyaki</h4>
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">Rp 12.000</p>
                                                                <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $(".add-to-cart").click(function() {
                                                                            var menuId = $(this).data("id");
                                                                            var menuName = $(this).data("name");
                                                                            var menuPrice = $(this).data("price");

                                                                            $.ajax({
                                                                                url: "{{ route('cart.add') }}", // Rute ke controller untuk menambahkan ke cart
                                                                                method: "POST",
                                                                                data: {
                                                                                    _token: "{{ csrf_token() }}",
                                                                                    id: menuId,
                                                                                    name: menuName,
                                                                                    price: menuPrice
                                                                                },
                                                                                success: function(response) {
                                                                                    alert("Item berhasil ditambahkan ke keranjang!");
                                                                                    location.reload(); // Reload untuk update cart di index.blade.php
                                                                                }
                                                                            });
                                                                        });
                                                                    });
                                                                </script> -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="{{ asset('img/stand/Stand 4.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Foods</div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>Gado-Gado</h4>
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">Rp 10.000</p>
                                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart" 
                                                                data-id="1" 
                                                                data-name="Gado-Gado" 
                                                                data-price="10000" 
                                                                data-image="{{ asset('img/stand/Stand 4.jpg') }}">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="{{ asset('img/stand/Stand 2.jpg') }}" class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Foods</div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>Ayam Geprek</h4>
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">Rp 10.000</p>
                                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart" data-name="Ayam Geprek" data-price="10000" data-image="img/stand/Stand 2.jpg"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="{{ asset('img/stand/Stand 6.jpg')}}" class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Foods</div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>Nasi Uduk</h4>
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">Rp 10.000</p>
                                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart" data-name="Nasi Uduk" data-price="10000" data-image="img/stand/Stand 6.jpg"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="{{ asset('img/stand/Stand 7.jpg')}}" class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Foods</div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>Ayam Kecap</h4>
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">Rp 10.000</p>
                                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart" data-name="Ayam Kecap" data-price="10000" data-image="img/stand/Stand 7.jpg"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="{{ asset('img/stand/Stand 8.jpg')}}" class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Foods</div>
                                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>Ayam Bakar</h4>
                                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">Rp 10.000</p>
                                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary btn-add-to-cart" data-name="Ayam Bakar" data-price="10000" data-image="img/stand/Stand 8.jpg"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="pagination d-flex justify-content-center mt-5">
                                                        <a href="#" class="rounded">&laquo;</a>
                                                        <a href="#" class="active rounded">1</a>
                                                        <a href="#" class="rounded">2</a>
                                                        <a href="#" class="rounded">3</a>
                                                        <a href="#" class="rounded">&raquo;</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add more carousel items for food as needed -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#foodCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#foodCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div id="tab-drink" class="tab-pane fade show p-0">
                                    <div id="drinkCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="row g-4">
                                                    @for($i = 1; $i <= 5; $i++)
                                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                                        <div class="rounded position-relative fruite-item">
                                                            <div class="fruite-img">
                                                                <img src="{{ asset('img/drink1.jpg') }}" class="img-fluid w-100 rounded-top" alt="Drink {{ $i }}">
                                                            </div>
                                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Drinks</div>
                                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                                <h4>Drink {{ $i }}</h4>
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp 5.000</p>
                                                                </div>
                                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary mt-3"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <!-- Add more carousel items for drink as needed -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#drinkCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#drinkCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div id="tab-snack" class="tab-pane fade show p-0">
                                    <div id="snackCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="row g-4">
                                                    @for($i = 1; $i <= 5; $i++)
                                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                                        <div class="rounded position-relative fruite-item">
                                                            <div class="fruite-img">
                                                                <img src="{{ asset('img/Nasi Uduk.jpg') }}" class="img-fluid w-100 rounded-top" alt="Snack {{ $i }}">
                                                            </div>
                                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Snacks</div>
                                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                                <h4>Snack {{ $i }}</h4>
                                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp 7.000</p>
                                                                </div>
                                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary mt-3"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <!-- Add more carousel items for snack as needed -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#snackCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#snackCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
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
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Foods</a>
                                            <span>(10)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Drinks</a>
                                            <span>(15)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Snacks</a>
                                            <span>(4)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-4">Featured products</h4>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('img/Ayam Teriyaki.jpg') }}" class="img-fluid rounded" alt="Image">
                                </div>
                                <div>
                                    <h6 class="mb-2">Ayam Teriyaki</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">Rp 10.000</h5>
                                        <h5 class="text-danger text-decoration-line-through">Rp 12.000</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('img/featur-2.jpg') }}" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Ayam Teriyaki</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">Rp 10.000</h5>
                                        <h5 class="text-danger text-decoration-line-through">Rp 12.000</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('img/featur-3.jpg') }}" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Ayam Teriyaki</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">Rp 10.000</h5>
                                        <h5 class="text-danger text-decoration-line-through">Rp 12.000</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 80px; height: 80px;">
                                    <img src="{{ asset('img/vegetable-item-4.jpg') }}" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Ayam Teriyaki</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">Rp 10.000</h5>
                                        <h5 class="text-danger text-decoration-line-through">Rp 12.000</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 80px; height: 80px;">
                                    <img src="{{ asset('img/vegetable-item-5.jpg') }}" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Ayam Teriyaki</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">Rp 10.000</h5>
                                        <h5 class="text-danger text-decoration-line-through">Rp 12.000</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="{{ url('/') }}">Home</a>
                    <a class="btn btn-link" href="{{ url('/stand') }}">Stand</a>
                    <a class="btn btn-link" href="{{ url('/aboutus') }}">About Us</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/Nasi Uduk.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-4.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-5.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-6.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!-- This template is free as long as you keep the footer credit. -->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    <!-- Tambahkan jQuery untuk AJAX -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        $(".btn-add-to-cart").click(function (e) {
            e.preventDefault();

            let menuId = $(this).data("id"); 
            let menuName = $(this).data("name");
            let menuPrice = $(this).data("price");
            let menuImage = $(this).data("image");

            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "POST",
                data: {
                    menu_id: menuId,
                    name: menuName,
                    price: menuPrice,
                    image: menuImage,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function () {
                    alert("Gagal menambahkan ke cart");
                }
            });
        });
    });
    </script> -->
</body>

</html>