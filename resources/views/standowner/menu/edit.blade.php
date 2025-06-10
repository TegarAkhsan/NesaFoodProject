@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Menu: {{ $menu->nama }}</h1>

    <a href="{{ route('standowner.menu.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Menu</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('standowner.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $menu->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $menu->harga) }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori', $menu->kategori) }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            @if($menu->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" width="150">
                </div>
            @endif
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            <small class="form-text text-muted">Upload gambar baru untuk mengganti gambar lama.</small>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Menu</button>
    </form>
</div>
@endsection
