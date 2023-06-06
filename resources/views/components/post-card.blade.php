<div
    class="items-stretch w-full basis-full sm:basis-auto sm:w-[320px] p-6 bg-white border border-gray-200 rounded-lg shadow">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-2">{{ $post->title }}</h5>
    <p class="mb-3 font-normal text-gray-700 line-clamp-3">{{ $post->content }}</p>
    <x-tag-button :tag="$post->category->name" />
    <div class="w-full h-0.5 bg-black-300 bg-opacity-25 my-2"></div>
    <div class="flex flex-wrap items-center justify-between gap-4 sm:gap-0">
        <x-post-status :likesCount="$post->likesCount" :dislikesCount="$post->dislikesCount" :commentsCount="$post->commentsCount" isLiked="$post->isLiked"
            isDisliked="$post->isDisliked" />
        <a href="{{ route('posts.show', $post->slug) }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg cursor-pointer hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
            Read more
            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</div>
