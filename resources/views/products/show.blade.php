<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $product->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded p-6 space-y-2">
            <p><span class="font-semibold">Kategori:</span> {{ $product->category->name }}</p>
            <p><span class="font-semibold">Harga:</span> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p><span class="font-semibold">Stok:</span> {{ $product->stock }}</p>
            <p><span class="font-semibold">Rating rata-rata:</span>
                {{ $product->reviews_avg_rating ? number_format($product->reviews_avg_rating, 1) : 'Belum ada review' }}</p>
            <p><span class="font-semibold">Dibuat oleh:</span> {{ $product->creator->name }}</p>
            <p class="text-gray-600 pt-2">{{ $product->description }}</p>
            <a href="{{ route('products.index') }}" class="inline-block pt-4 text-blue-600 hover:underline">&larr; Kembali</a>
        </div>
    </div>
</x-app-layout>
