<div class="flex flex-col items-start p-4 space-y-4 bg-white rounded shadow-sm md:p-8 basis-full md:basis-3/4">
    <div class="space-y-2">
        <h1 class="text-lg font-semibold text-black-700">{{ $post->title }}</h1>
        <span class="block text-sm font-extralight">{{ $post->created_at->diffForHumans() }}</span>
    </div>
    <p class="text-sm leading-loose text-black-400">{{ $post->content }}</p>
    <div class="flex items-center">
        <span class="mr-2 font-medium">Tags:</span>
        <x-tag-button :tag="$post->category->name" />
    </div>
    <x-post-status :likesCount="$post->likesCount" :dislikesCount="$post->dislikesCount" :commentsCount="$post->commentsCount" isLiked="$post->isLiked"
        isDisliked="$post->isDisliked" />

    @guest
        <div class="flex items-center w-full h-16 rounded bg-black-100">
            <div class="w-2 h-full mr-4 bg-black-600"></div>
            <span class="text-black-500">
                <a href="{{ route('show.login') }}" class="transition text-leaf hover:text-earth">Log in</a>
                or
                <a href="{{ route('show.register') }}" class="transition text-leaf hover:text-earth">sign up</a>
                to leave a comment.
            </span>
        </div>
    @endguest

    @auth
        <x-comment-form :postSlug="$post->slug" />
    @endauth


    @forelse($post->comments as $comment)
        <div class="flex flex-col items-start w-full space-y-6">
            <x-comment-card :comment="$comment" />
        </div>
    @empty
        <div class="flex items-center w-full p-4 space-x-4 shadow bg-black-50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 text-black-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
            </svg>
            <div class="space-y-2">
                <span class="block text-lg font-medium text-black-700">No Comments Yet
                </span>
                <span class="block text-sm text-black-400">Be the first to respond.
                </span>
            </div>
        </div>
    @endforelse
</div>

<script>
    textarea = document.querySelector("#chat");
    textarea.addEventListener('input', autoResize, false);

    function autoResize() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    }

    function toggleLike() {
        let like = document.querySelectorAll('.comment-like');
        let dislike = document.querySelectorAll('.comment-dislike');

        const LIKE_TYPE = 1;
        const DISLIKE_TYPE = 0;

        async function updateCommentStatus(url = "", data = {}) {
            const response = await fetch(url, {
                method: "POST",
                mode: "cors",
                cache: "no-cache",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer {{ Auth::user()->api_token }}",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            })
            return response.json();
        };

        like.forEach(element => {
            element.addEventListener('click', function() {
                const commentLikeCount = element.querySelector('.comment-like-count');
                const commentLikeIcon = element.querySelector('.like-icon');

                const commentId = element.parentElement.parentElement.dataset.commentId;;
                updateCommentStatus('/api/likes', {
                    comment_id: commentId,
                    like_type: LIKE_TYPE
                }).then(data => {
                    console.log(data);
                }).catch(error => {
                    console.log(error);
                });


                if (element.classList.contains('bg-green-200')) {
                    commentLikeCount.textContent = parseInt(commentLikeCount.textContent) - 1;
                } else {
                    commentLikeCount.textContent = parseInt(commentLikeCount.textContent) + 1;
                }

                element.classList.toggle('bg-green-200');
                element.classList.toggle('hover:bg-green-50');

                commentLikeCount.classList.toggle('text-green-600');
                commentLikeIcon.classList.toggle('stroke-green-600');
            });
        });

        dislike.forEach(element => {
            element.addEventListener('click', function() {
                const commentDislikeCount = element.querySelector('.comment-dislike-count');
                const commentDislikeIcon = element.querySelector('.dislike-icon');

                if (element.classList.contains('bg-red-200')) {
                    commentDislikeCount.textContent = parseInt(commentDislikeCount.textContent) - 1;
                } else {
                    commentDislikeCount.textContent = parseInt(commentDislikeCount.textContent) + 1;
                }
                element.classList.toggle('bg-red-200');
                element.classList.toggle('hover:bg-red-50');

                commentDislikeCount.classList.toggle('text-red-600');
                commentDislikeIcon.classList.toggle('stroke-red-600');
            });
        });
    }

    toggleLike()
</script>
