@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2>Logout</h2>
    <p>Apakah Anda yakin ingin logout?</p>
    <form method="POST" action="{{ url('/auth/logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
