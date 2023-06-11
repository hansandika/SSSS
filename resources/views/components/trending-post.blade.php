<div class="flex flex-col p-4 bg-white rounded shadow-sm basis-full md:basis-1/4 md:p-8">
    <h2 class="mb-4 text-xl font-bold text-gray-800"><i class="mr-2 uil uil-fire"></i>Trending Posts</h2>
    <ul class="space-y-4">
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->slug) }}"
                    class="flex flex-col space-y-1 text-gray-700 hover:text-gray-900">
                    <span class="font-semibold line-clamp-2">{{ $post->title }}</span>
                    <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                    <span class="text-xs text-gray-700 line-clamp-3">{{ $post->content }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
