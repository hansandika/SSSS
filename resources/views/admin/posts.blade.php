<x-app-layout-admin title="Admin List Posts">
    <x-content-wrapper title="Posts" link="/admin/posts">
        @foreach ($posts as $post)
            <div>
                <h1 class='text-lg font-semibold transition text-black-700'>{{ Str::limit($post->title, 50) }}</h1>
                <p class='text-sm text-black-300'>{{ Str::limit($post->content, 100) }}</p>

                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('posts.edit', $post->slug) }}" class='transition text-black-700 hover:underline'>
                        Edit
                    </a>

                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class='transition text-black-700 hover:underline'>Delete</button>
                    </form>
                </div>
                <hr class='mt-2' />
            </div>
        @endforeach
    </x-content-wrapper>
</x-app-layout-admin>
