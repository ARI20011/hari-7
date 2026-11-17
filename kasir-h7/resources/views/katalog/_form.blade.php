<form action="{{ $action }}" method="POST" class="product-form">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="form-field">
        <label for="nama">Nama produk</label>
        <input id="nama" name="nama" value="{{ old('nama', $product->nama ?? '') }}" required maxlength="150">
        @error('nama')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-field">
        <label for="kategori">Kategori</label>
        <input id="kategori" name="kategori" value="{{ old('kategori', $product->kategori ?? '') }}"
            required maxlength="100">
        @error('kategori')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-field">
        <label for="harga">Harga (Rp)</label>
        <input id="harga" type="number" name="harga" value="{{ old('harga', $product->harga ?? '') }}"
            required min="0" max="999999999999">
        @error('harga')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-field">
        <label for="stok">Stok</label>
        <input id="stok" type="number" name="stok" value="{{ old('stok', $product->stok ?? 0) }}"
            required min="0" max="999999999">
        @error('stok')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-actions">
        <button class="button" type="submit">{{ $buttonLabel }}</button>
        <a class="reset-link" href="{{ route('katalog.index') }}">Batal</a>
    </div>
</form>
