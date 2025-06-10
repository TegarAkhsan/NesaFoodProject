@extends('layouts.app')
@section('title', 'Nesafood - Home')
@section('content')

    <!-- Keranjang Belanja Modern -->
    <div class="container py-5" style="margin-top: 80px;">
        @if(count($items) > 0)
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4 fw-bold">Keranjang Belanja</h4>

                        <!-- Tabel Item -->
                        <div class="table-responsive mb-4">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Total</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td class="fw-medium">{{ $item['name'] }}</td>
                                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle btn-update" data-id="{{ $item['id'] }}" data-type="decrease">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <span class="fw-semibold">{{ $item['quantity'] }}</span>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle btn-update" data-id="{{ $item['id'] }}" data-type="increase">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-3 btn-remove" data-id="{{ $item['id'] }}">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Kode Promo -->
                        <div class="mb-3">
                            <label for="promo" class="form-label fw-medium">Kode Promo</label>
                            <div class="input-group">
                                <input type="text" name="promo" id="promo" class="form-control" placeholder="Masukkan kode promo jika ada">
                                <button class="btn btn-outline-primary" type="button">Terapkan</button>
                            </div>
                        </div>

                        <!-- Input Catatan -->
                        <div class="mb-4">
                            <label for="catatan" class="form-label fw-medium">Catatan Tambahan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Masukkan catatan jika ada">{{ session('checkout_note') }}</textarea>
                        </div>


                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger rounded-pill px-4">
                                <i class="bi bi-x-circle"></i> Kosongkan
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold">
                                Checkout <i class="bi bi-arrow-right-circle ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-info text-center rounded-4 shadow-sm">
                Keranjang Anda masih kosong.
            </div>
        @endif
    </div>
    <!-- Keranjang Belanja Modern End -->
     
    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Update jumlah
            document.querySelectorAll('.btn-update').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.dataset.id;
                    const type = this.dataset.type;

                    fetch("{{ route('cart.update') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            id: itemId,
                            type: type
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    });
                });
            });

            // Hapus item
            document.querySelectorAll('.btn-remove').forEach(button => {
                button.addEventListener('click', function () {
                    const itemId = this.dataset.id;

                    fetch("{{ url('cart/remove') }}/" + itemId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    });
                });
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
