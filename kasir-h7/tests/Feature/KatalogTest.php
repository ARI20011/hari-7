<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ProductSeeder::class);
    }

    public function test_katalog_menampilkan_produk(): void
    {
        $this->get('/katalog')
            ->assertOk()
            ->assertSee('Kopi Ende')
            ->assertSee('Roti Cokelat')
            ->assertSee('Tersedia')
            ->assertSee('Habis')
            ->assertSee('css/kasir.css')
            ->assertSee('name="q"', false)
            ->assertSee('Tambah produk')
            ->assertSee('Atur produk');
    }

    public function test_pencarian_get_memfilter_produk_dan_menangani_hasil_kosong(): void
    {
        $this->get('/katalog?q=kopi')
            ->assertOk()
            ->assertSee('Kopi Ende')
            ->assertDontSee('Roti Cokelat')
            ->assertSee('value="kopi"', false);

        $this->get('/katalog?q=tidak-ada')
            ->assertOk()
            ->assertSee('Produk tidak ditemukan.');
    }

    public function test_detail_produk_dapat_dibuka_dan_produk_tidak_ditemukan_menghasilkan_404(): void
    {
        $this->get('/katalog/1')
            ->assertOk()
            ->assertSee('Kopi Ende')
            ->assertSee('Rp 15.000')
            ->assertSee('Tersedia')
            ->assertSee('Kembali ke katalog');

        $this->get('/katalog/999')->assertNotFound();
        $this->get('/katalog/abc')->assertNotFound();
    }

    public function test_produk_dapat_ditambahkan_diperbarui_dan_dihapus(): void
    {
        $this->get(route('katalog.create'))
            ->assertOk()
            ->assertSee('Tambah produk');

        $this->post(route('katalog.store'), [
            'nama' => 'Teh Ende',
            'kategori' => 'Minuman',
            'harga' => 5000,
            'stok' => 8,
        ])->assertRedirect();

        $product = Product::query()->where('nama', 'Teh Ende')->firstOrFail();
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'nama' => 'Teh Ende',
            'stok' => 8,
        ]);

        $this->get(route('katalog.edit', $product))
            ->assertOk()
            ->assertSee('value="Teh Ende"', false);

        $this->put(route('katalog.update', $product), [
            'nama' => 'Teh Hijau Ende',
            'kategori' => 'Minuman',
            'harga' => 6000,
            'stok' => 3,
        ])->assertRedirect(route('katalog.show', $product));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'nama' => 'Teh Hijau Ende',
            'harga' => 6000,
            'stok' => 3,
        ]);

        $this->delete(route('katalog.destroy', $product))
            ->assertRedirect(route('katalog.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_produk_tidak_disimpan_dengan_data_yang_tidak_valid(): void
    {
        $this->from(route('katalog.create'))
            ->post(route('katalog.store'), [
                'nama' => '',
                'kategori' => 'Minuman',
                'harga' => 5000,
                'stok' => -1,
            ])
            ->assertRedirect(route('katalog.create'))
            ->assertSessionHasErrors(['nama', 'stok']);

        $this->assertDatabaseCount('products', 2);
    }
}
