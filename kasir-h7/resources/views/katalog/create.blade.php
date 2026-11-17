@extends('layouts.app')

@section('title', 'Tambah Produk - Katalog')

@section('content')
    <a class="back-link" href="{{ route('katalog.index') }}">&larr; Kembali ke katalog</a>
    <h1>Tambah produk</h1>

    @include('katalog._form', [
        'product' => null,
        'action' => route('katalog.store'),
        'method' => 'POST',
        'buttonLabel' => 'Simpan produk',
    ])
@endsection
