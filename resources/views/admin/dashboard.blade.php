<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-4 md:grid-cols-3">
                <div class="bg-white shadow rounded p-6">
                    <p class="text-gray-500 text-sm">Total User</p>
                    <p class="text-3xl font-bold">{{ $jumlahUser }}</p>
                </div>
                <div class="bg-white shadow rounded p-6">
                    <p class="text-gray-500 text-sm">Total Produk</p>
                    <p class="text-3xl font-bold">{{ $jumlahProduk }}</p>
                </div>
                <div class="bg-white shadow rounded p-6">
                    <p class="text-gray-500 text-sm">Total Pesanan</p>
                    <p class="text-3xl font-bold">{{ $jumlahPesanan }}</p>
                </div>
            </div>

            <div class="bg-white shadow rounded p-6 mt-4">
                <p class="font-semibold mb-2">User per role</p>
                <ul class="list-disc pl-6">
                    @foreach ($perRole as $role => $total)
                        <li>{{ ucfirst($role) }}: {{ $total }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
