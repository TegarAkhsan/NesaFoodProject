@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Menu Stand</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('standowner.menu.create') }}" class="btn btn-primary mb-3">Tambah Menu Baru</a>

    @if($menus->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->nama }}</td>
                    <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td>
                        @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" width="80">
                        @else
                            <em>Tidak ada gambar</em>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('standowner.menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('standowner.menu.destroy', $menu->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada menu yang ditambahkan.</p>
    @endif
</div>
@endsection
