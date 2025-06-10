@extends('layouts.app')
@section('title', 'Nesafood - About Us')
@section('content')

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">About Us</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">About Us</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary mb-3">Tentang NesaFood</h1>
                                <p class="mb-4">
                                    <strong>NesaFood</strong> adalah platform digital inovatif yang mempermudah civitas akademika UNESA dalam menikmati ragam kuliner kampus. Melalui fitur pencarian menu, pemesanan online, dan info tenant terkini, kami hadir untuk menjawab kebutuhan makan cepat, praktis, dan efisien tanpa harus antre.
                                </p>
                                <p class="mb-4">
                                    Apakah kamu mahasiswa sibuk, dosen yang ingin serba cepat, atau pengunjung kampus? NesaFood hadir untukmu. Temukan makanan favoritmu hanya dalam beberapa klik!
                                </p>
                                <a class="btn btn-primary px-4 py-2" href="#">Download Aplikasi</a>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <input type="text" name="name" class="w-100 form-control border-0 py-3 mb-4" placeholder="Nama Anda" required>
                                <input type="email" name="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Email Anda" required>
                                <textarea name="message" class="w-100 form-control border-0 mb-4" rows="5" placeholder="Pesan Anda" required></textarea>
                                <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="submit">Kirim Pesan</button>
                            </form>
                        </div>

                        <div class="col-lg-5">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Alamat</h4>
                                    <p class="mb-2">Foodcourt UNESA Ketintang, Surabaya</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Email</h4>
                                    <p class="mb-2">support@nesafood.id</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Telepon</h4>
                                    <p class="mb-2">(+62) 812-3456-7890</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

@endsection
