@extends('layouts.app')
@section('title', 'Checkout')
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

        <!-- Checkout Form Start -->
        <div class="container py-5" style="margin-top: 80px;">
            <h2 class="mb-4">Halaman Checkout</h2>

            <div class="row">
                <!-- Form Checkout -->
                <div class="col-md-7">  
                    <form action="{{ route('cart.processCheckout') }}" method="POST" id="checkout-form">
                        @csrf

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Kode Promo -->
                        <div class="mb-3">
                            <label for="promo_code" class="form-label">Kode Promo</label>
                            <input type="text" name="promo_code" id="promo_code" class="form-control" placeholder="Contoh: DISKON10" value="{{ request()->get('promo') }}">
                        </div>

                        <!-- (Catatan DIHAPUS dari form) -->

                        <!-- Metode Pembayaran -->
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">Cash on Delivery</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>

                        <!-- Kirim juga nilai catatan sebagai hidden input -->
                        <input type="hidden" name="note" value="{{ request()->get('catatan') }}">

                        <button type="submit" class="btn btn-primary rounded-pill px-5">Proses Checkout</button>
                    </form>
                </div>

                <!-- Summary Pesanan -->
                <div class="col-md-5">
                    <div class="card shadow-sm border-0 rounded-4 p-4">
                        <h4 class="mb-4 fw-bold">Ringkasan Pesanan</h4>
                        @php $grandTotal = 0; @endphp
                        @if(count($items) > 0)
                            <ul class="list-group mb-3">
                                @foreach($items as $item)
                                    @php
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $grandTotal += $subtotal;
                                    @endphp
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $item['name'] }}</strong><br>
                                            <small>{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                                        </div>
                                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Preview Promo -->
                            <div class="mb-2">
                                <strong>Kode Promo:</strong> <span id="previewPromo">{{ request()->get('promo') ?? '-' }}</span>
                            </div>

                            <!-- Preview Catatan -->
                            <div class="mb-3">
                                <label class="form-label fw-medium">Catatan Tambahan</label>
                                <div class="form-control bg-light">
                                    {{ session('checkout_note') ?? 'Tidak ada catatan.' }}
                                </div>
                            </div>


                            <!-- Total -->
                            <div class="d-flex justify-content-between fw-semibold fs-5 border-top pt-3">
                                <span>Total</span>
                                <span id="totalHarga">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>

                            <!-- Potongan -->
                            <div id="potonganHarga" class="text-success fw-semibold mt-2 d-none">
                                Promo DISKON10 aktif -10%
                            </div>
                        @else
                            <p>Keranjang belanja kosong.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">NesaFood</h1>
                                <p class="text-secondary mb-0">Food Court UNESA</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                                <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Why People Like us!</h4>
                            <p class="mb-4">NesaFood mempermudah akses ke foodcourt UNESA dengan pemesanan cepat, pilihan beragam, dan pengalaman kuliner yang praktis serta efisien.</p>
                            <a href="{{ url('/aboutus') }}" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Nesa Info</h4>
                            <a href="{{ url('/aboutus') }}" class="btn-link" href="">About Us</a>
                            <a href="{{ url('/aboutus') }}" class="btn-link" href="">Contact Us</a>
                            <a href="{{ url('/aboutus') }}" class="btn-link" href="">Terms & Condition</a>
                            <a href="{{ url('/aboutus') }}" class="btn-link" href="">Return Policy</a>
                            <a href="{{ url('/aboutus') }}" class="btn-link" href="">FAQs & Help</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Nesa Account</h4>
                            <a class="btn-link" href="">My Account</a>
                            <a class="btn-link" href="">Shop details</a>
                            <a class="btn-link" href="">Shopping Cart</a>
                            <a class="btn-link" href="">Wishlist</a>
                            <a class="btn-link" href="">Order History</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Nesa Contact</h4>
                            <p>Address: UNESA Ketintang</p>
                            <p>Email: Example@gmail.com</p>
                            <p>Phone: +62 8999 2343</p>
                            <p>Payment Accepted</p>
                            <img src="img/payment.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection
