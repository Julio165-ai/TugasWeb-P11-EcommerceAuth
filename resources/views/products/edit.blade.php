<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Produk</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded p-6">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @include('products._form')
            </form>
        </div>
    </div>
</x-app-layout>
