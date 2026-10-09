<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Post</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}"
                   class="inline-block mb-4 px-4 py-2 bg-gray-800 text-white rounded-md text-sm">
                    + Tambah Post
                </a>
            @endcan

            @forelse ($posts as $post)
                <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $post->title }}</h3>
                    <p class="text-xs text-gray-500 mb-2">
                        Oleh {{ $post->user->name }} · {{ $post->created_at->format('d M Y') }}
                    </p>
                    <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($post->body, 200) }}</p>

                    <div class="mt-4 flex items-center gap-4">
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="text-sm text-blue-600 underline">Edit</a>
                        @endcan

                        @can('delete', $post)
                            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                  onsubmit="return confirm('Hapus post ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 underline">Hapus</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Belum ada post.</p>
            @endforelse

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>