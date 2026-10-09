@csrf
<div class="mb-4">
    <label for="title" class="block font-medium text-sm text-gray-700">Judul</label>
    <input id="title" name="title" type="text" value="{{ old('title', $post->title ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="body" class="block font-medium text-sm text-gray-700">Isi</label>
    <textarea id="body" name="body" rows="6"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('body', $post->body ?? '') }}</textarea>
    @error('body')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-4">
    <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Simpan</button>
    <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 underline">Batal</a>
</div>