<x-app-layout title="{{ $post->title }}">
    <div class="flex items-center gap-2">
        <x-post-show-card :post="$post" />
        <div class="hidden md:flex basis-full md:basis-1/4">

        </div>
    </div>
</x-app-layout>
