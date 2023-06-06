<x-app-layout title='Home'>
    <x-search-bar />
    <div class="flex flex-col md:space-x-4 md:flex-row">
        <div class="md:basis-1/4">
            <x-filter-card :categories="$categories" />
        </div>
        <div class="flex flex-wrap items-start gap-4 md:basis-3/4">
            @forelse ($posts as $post)
                <x-post-card :post="$post" />
            @empty
                <h2 class="text-2xl text-red-500">There are no posts yet!</h2>
            @endforelse
            {{ $posts->appends(Request::all())->links('pagination::tailwind') }}
        </div>
    </div>
    @auth
        <x-redirect-create-post />
    @endauth
</x-app-layout>
