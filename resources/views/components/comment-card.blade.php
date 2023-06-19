<div {{ $attributes->merge(['class' => 'flex flex-col items-start w-full p-4 space-y-2 rounded']) }}
    data-comment-id="{{ $comment->id }}">
    <div class="flex items-center space-x-4">
        <span class="text-lg font-semibold text-blue-700">{{ $comment->author }}</span>
        @if ($comment->user->glc_verified)
            <span class="flex items-center text-sm text-nature">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                </svg>
                GLC Verified
            </span>
        @endif
        <span class="text-sm font-extralight">{{ $comment->updated_at->diffForHumans() }}</span>
        <p class="text-sm font-semibold text-yellow-300">
            <i class="uil uil-favorite"></i>
            <span id="user-rating">
                {{ $comment->user->rating }}
            </span>
        </p>
    </div>
    <p class="text-xs leading-loose sm:text-sm">{{ $comment->content }}
    </p>
    <x-comment-status :likesCount="$comment->likes_count" :dislikesCount="$comment->dislikes_count"
        isLiked="{{ Auth::check() ? $comment->likedBy(Auth::user()) : false }}"
        isDisliked="{{ Auth::check() ? $comment->dislikedBy(Auth::user()) : false }}" :postSlug="$comment->post->slug"
        :parentId="$parentId" />
    @foreach ($comment->replies as $reply)
        <div class="w-full ml-2">
            <x-comment-card :comment="$reply" />
        </div>
    @endforeach
</div>
