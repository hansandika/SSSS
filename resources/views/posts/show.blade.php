<x-app-layout title="{{ $post->title }}">
    <div class="flex flex-col items-start gap-4 md:flex-row">
        <x-post-show-card :post="$post" />
        <x-trending-post :posts="$popularPosts" />
    </div>
</x-app-layout>
