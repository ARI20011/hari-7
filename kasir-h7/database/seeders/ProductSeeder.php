<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::updateOrCreate(
            ['nama' => 'Kopi Ende'],
            ['kategori' => 'Minuman', 'harga' => 15000, 'stok' => 12]
        );

        Product::updateOrCreate(
            ['nama' => 'Roti Cokelat'],
            ['kategori' => 'Makanan', 'harga' => 8000, 'stok' => 0]
        );
    }
}
