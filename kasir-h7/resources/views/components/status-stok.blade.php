@props(['stok'])

@if ($stok > 0)
    <span class="stock-status stock-status--available">Tersedia</span>
@else
    <span class="stock-status stock-status--unavailable">Habis</span>
@endif
