@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Kasir Ende</p>
            <h1>Katalog Produk</h1>
        </div>
        <a class="button" href="{{ route('katalog.create') }}">Tambah produk</a>
    </div>

    @if (session('status'))
        <p class="alert-success" role="status">{{ session('status') }}</p>
    @endif

    <form action="{{ route('katalog.index') }}" method="GET" class="search-form" role="search">
        <label for="q">Cari produk</label>
        <div class="search-controls">
            <input id="q" type="search" name="q" value="{{ $q }}" placeholder="Nama atau kategori">
            <button type="submit">Cari</button>
            @if ($q !== '')
                <a class="reset-link" href="{{ route('katalog.index') }}">Hapus pencarian</a>
            @endif
        </div>
    </form>

    <section class="product-grid" aria-label="Daftar produk">
        @forelse ($produk as $product)
            <article class="product-card">
                <div class="product-card__heading">
                    <h2>
                        <a href="{{ route('katalog.show', $product) }}">{{ $product->nama }}</a>
                    </h2>
                    <x-status-stok :stok="$product->stok" />
                </div>
                <p class="product-category">{{ $product->kategori }}</p>
                <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <p class="product-stock">Stok: {{ $product->stok }}</p>
                <div class="card-actions">
                    <a class="button button--secondary" href="{{ route('katalog.edit', $product) }}">Atur produk</a>
                    <form action="{{ route('katalog.destroy', $product) }}" method="POST"
                        onsubmit="return confirm('Hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="button button--danger" type="submit">Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="empty-state">Produk tidak ditemukan.</p>
        @endforelse
    </section>

    {{ $produk->links() }}
@endsection
