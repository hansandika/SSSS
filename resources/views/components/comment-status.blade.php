<div class="flex items-center space-x-2">
    <div
        class="flex items-center p-2 space-x-1 transition rounded-lg cursor-pointer bg-black-100 group hover:bg-green-200 comment-like">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5 group-hover:stroke-green-600 like-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
        <span
            class="text-sm font-medium text-gray-900 group-hover:text-green-600 comment-like-count">{{ $likesCount }}</span>
    </div>
    <div
        class="flex items-center p-2 space-x-1 transition rounded-lg cursor-pointer group bg-black-100 hover:bg-red-200 comment-dislike">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-5 h-5 group-hover:stroke-red-600 dislike-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
        <span
            class="text-sm font-medium text-gray-900 group-hover:text-red-600 comment-dislike-count">{{ $dislikesCount }}</span>
    </div>
    <span
        class="p-2 text-sm transition rounded-lg cursor-pointer font-extralight hover:text-blue-600 hover:bg-blue-300">Reply</span>
</div>
