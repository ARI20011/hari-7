<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'q' => ['sometimes', 'nullable', 'string', 'max:100'],
        ]);
        $q = trim($validated['q'] ?? '');

        $produk = Product::query()
            ->when($q !== '', function ($query) use ($q): void {
                $query->where(function ($query) use ($q): void {
                    $query->where('nama', 'like', "%{$q}%")
                        ->orWhere('kategori', 'like', "%{$q}%");
                });
            })
            ->orderBy('nama')
            ->paginate(12)
            ->withQueryString();

        return view('katalog.index', compact('produk', 'q'));
    }

    public function create(): View
    {
        return view('katalog.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::create($this->validatedData($request));

        return redirect()
            ->route('katalog.show', $product)
            ->with('status', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product): View
    {
        return view('katalog.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('katalog.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($this->validatedData($request));

        return redirect()
            ->route('katalog.show', $product)
            ->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()
            ->route('katalog.index')
            ->with('status', 'Produk berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'kategori' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'integer', 'min:0', 'max:999999999999'],
            'stok' => ['required', 'integer', 'min:0', 'max:999999999'],
        ]);
    }
}
