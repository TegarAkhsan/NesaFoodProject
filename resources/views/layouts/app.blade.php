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

        <!-- AOS -->
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>
<body>
    @include('layouts.navigation')

    <div>
        @yield('content')
    </div>

    @include('layouts.footer')

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        let cart = [];

        function addToCart(product) {
            cart.push(product);
            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Product added to cart');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const cartIcon = document.querySelector('.fa-shopping-bag');
            cartIcon.addEventListener('click', function() {
                window.location.href = '{{ url("/cart") }}';
            });

            const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const product = {
                        name: this.dataset.name,
                        price: this.dataset.price,
                        image: this.dataset.image
                    };
                    addToCart(product);
                });
            });
        });
    </script>

    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdownMenu');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }

        // Optional: klik di luar area dropdown akan menutup
        document.addEventListener('click', function (event) {
            const wrapper = document.getElementById('userDropdownWrapper');
            const menu = document.getElementById('userDropdownMenu');
            if (!wrapper.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>


    <!-- Script JS Bootstrap, FontAwesome, dll -->
</body>
</html>
