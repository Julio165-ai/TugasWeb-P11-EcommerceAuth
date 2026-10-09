<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when(! $request->user()->hasRole('admin', 'editor'), fn ($q) => $q->active())
            ->search($request->q)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'creator'])->loadAvg('reviews', 'rating');

        return view('products.show', compact('product'));
    }

    public function create()
    {
        Gate::authorize('create', Product::class);

        return view('products.create', ['categories' => Category::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Product::class);

        $data = $this->validated($request);
        $data['user_id']   = $request->user()->id;
        $data['slug']      = Str::slug($data['name']) . '-' . Str::lower(Str::random(4));
        $data['is_active'] = $request->boolean('is_active');

        Product::create($data);

        return redirect()->route('products.index')->with('status', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('products.edit', [
            'product'    => $product,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        Gate::authorize('update', $product);

        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')->with('status', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name'        => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'integer', 'min:1000'],
            'stock'       => ['required', 'integer', 'min:0'],
        ]);
    }
}
