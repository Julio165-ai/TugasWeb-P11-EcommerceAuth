<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Produk</h2>
            @can('create', App\Models\Product::class)
                <a href="{{ route('products.create') }}" class="px-3 py-2 bg-gray-800 text-white rounded text-sm">+ Produk</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <form method="GET" class="mb-4 flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                       class="flex-1 border-gray-300 rounded">
                <button class="px-4 bg-gray-800 text-white rounded">Cari</button>
            </form>

            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Stok</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-t">
                                <td class="p-3">
                                    <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline">{{ $product->name }}</a>
                                    @unless ($product->is_active)
                                        <span class="ml-1 text-xs text-red-600">(nonaktif)</span>
                                    @endunless
                                </td>
                                <td class="p-3">{{ $product->category->name }}</td>
                                <td class="p-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="p-3">{{ $product->stock }}</td>
                                <td class="p-3 flex gap-3">
                                    @can('update', $product)
                                        <a href="{{ route('products.edit', $product) }}" class="text-amber-600 hover:underline">Edit</a>
                                    @endcan
                                    @can('delete', $product)
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-3 text-gray-500">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>
