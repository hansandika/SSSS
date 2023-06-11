<x-app-layout title="Edit Post">
    <x-post-form title="Edit Post" action="Edit" method="PATCH" :post="$post" url="{{ '/posts/' . $post->slug }}" />
</x-app-layout>
