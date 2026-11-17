@extends('layouts.app')

@section('title', $product->nama.' - Katalog Produk')

@section('content')
    <a class="back-link" href="{{ route('katalog.index') }}">&larr; Kembali ke katalog</a>

    <article class="product-detail">
        @if (session('status'))
            <p class="alert-success" role="status">{{ session('status') }}</p>
        @endif
        <p class="eyebrow">{{ $product->kategori }}</p>
        <div class="product-card__heading">
            <h1>{{ $product->nama }}</h1>
            <x-status-stok :stok="$product->stok" />
        </div>
        <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
        <p class="product-stock">Stok: {{ $product->stok }}</p>
        <a class="button" href="{{ route('katalog.edit', $product) }}">Atur produk</a>
    </article>
@endsection
