@csrf
@isset($product)
    @method('PUT')
@endisset

<div class="mb-4">
    <label class="block font-medium text-sm text-gray-700 mb-1" for="category_id">Kategori</label>
    <select id="category_id" name="category_id" class="w-full border-gray-300 rounded">
        <option value="">-- Pilih kategori --</option>
        @foreach ($categories as $kategori)
            <option value="{{ $kategori->id }}" @selected(old('category_id', $product->category_id ?? '') == $kategori->id)>
                {{ $kategori->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
</div>

<div class="mb-4">
    <label class="block font-medium text-sm text-gray-700 mb-1" for="name">Nama Produk</label>
    <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full border-gray-300 rounded">
    <x-input-error :messages="$errors->get('name')" class="mt-1" />
</div>

<div class="mb-4">
    <label class="block font-medium text-sm text-gray-700 mb-1" for="description">Deskripsi</label>
    <textarea id="description" name="description" rows="4" class="w-full border-gray-300 rounded">{{ old('description', $product->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-1" />
</div>

<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block font-medium text-sm text-gray-700 mb-1" for="price">Harga (Rp)</label>
        <input type="number" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" class="w-full border-gray-300 rounded">
        <x-input-error :messages="$errors->get('price')" class="mt-1" />
    </div>
    <div>
        <label class="block font-medium text-sm text-gray-700 mb-1" for="stock">Stok</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="w-full border-gray-300 rounded">
        <x-input-error :messages="$errors->get('stock')" class="mt-1" />
    </div>
</div>

<label class="flex items-center gap-2 mb-6">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
    <span class="text-sm text-gray-700">Produk aktif</span>
</label>

<div class="flex gap-3">
    <button class="px-4 py-2 bg-gray-800 text-white rounded">Simpan</button>
    <a href="{{ route('products.index') }}" class="px-4 py-2 border rounded">Batal</a>
</div>
