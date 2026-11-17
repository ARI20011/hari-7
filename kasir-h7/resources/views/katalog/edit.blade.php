@extends('layouts.app')

@section('title', 'Atur '.$product->nama.' - Katalog')

@section('content')
    <a class="back-link" href="{{ route('katalog.show', $product) }}">&larr; Kembali ke detail</a>
    <h1>Atur produk</h1>

    @include('katalog._form', [
        'product' => $product,
        'action' => route('katalog.update', $product),
        'method' => 'PUT',
        'buttonLabel' => 'Simpan perubahan',
    ])
@endsection
