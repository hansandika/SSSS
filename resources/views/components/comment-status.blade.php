<div class="flex items-center space-x-2">
    <div class="group flex items-center p-2 space-x-1 transition rounded-lg cursor-pointer comment-like{{ $isLiked ? ' bg-green-200 hover:bg-green-100' : ' bg-black-100 hover:bg-green-200' }}"
        @guest onClick="window.location='{{ url('login') }}'" @endguest>
        <x-loading-icon />
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5 group-hover:stroke-green-600 comment-like-icon{{ $isLiked ? ' stroke-green-600' : ' stroke-black-500' }}">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
        <span
            class="text-sm font-medium group-hover:text-green-600 comment-like-count{{ $isLiked ? ' text-green-600' : ' text-gray-900' }}">{{ $likesCount }}</span>
    </div>
    <div class="flex items-center p-2 space-x-1 transition rounded-lg cursor-pointer group comment-dislike{{ $isDisliked ? ' bg-red-200 hover:bg-red-100' : ' bg-black-100 hover:bg-red-200' }}"
        @guest onClick="window.location='{{ url('login') }}'" @endguest>
        <x-loading-icon />
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5 group-hover:stroke-red-600 comment-dislike-icon{{ $isDisliked ? ' stroke-red-600' : ' stroke-black-500' }}">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
        <span
            class="text-sm font-medium group-hover:text-red-600 comment-dislike-count {{ $isDisliked ? ' text-red-600' : ' text-gray-900' }}">{{ $dislikesCount }}</span>
    </div>
    <span
        class="p-2 text-sm transition rounded-lg cursor-pointer font-extralight hover:text-blue-600 hover:bg-blue-300 reply-button"
        @guest onClick="window.location='{{ url('login') }}'" @endguest>Reply</span>
</div>
<x-comment-form :post-slug="$postSlug" :parent-id="$parentId" class="hidden pt-4 comment-form" />
