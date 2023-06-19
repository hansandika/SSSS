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
    <x-post-status :likesCount="$post->likesCount" :dislikesCount="$post->dislikesCount" :commentsCount="$post->commentsCount" isLiked="{{ $post->isLiked }}"
        isDisliked="{{ $post->isDisliked }}" />

    @author($post)
    <div class="flex items-center space-x-3">
        <a href="/posts/{{ $post->slug }}/edit" class="text-green-500 hover:underline">Edit</a>
        <form action="/posts/{{ $post->slug }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline">Delete</button>
        </form>
    </div>
    @endauthor

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
        <x-comment-form :postSlug="$post->slug" class="px-3 py-2 bg-gray-50" />
    @endauth


    @forelse($post->comments as $comment)
        <div class="flex flex-col items-start w-full space-y-6">
            <x-comment-card :comment="$comment" class="shadow-sm bg-black-50" />
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

@auth
    <script>
        textarea = document.querySelector("#chat");
        textarea.addEventListener('input', autoResize, false);

        function autoResize() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        }

        const LIKE_TYPE = 1;
        const DISLIKE_TYPE = 0;

        async function updateLikeStatus(url = "", data = {}) {
            const response = await fetch(url, {
                method: "POST",
                mode: "cors",
                cache: "no-cache",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer {{ Session::get('api_token') }}",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            })
            return response.json();
        };


        function toggleCommentLike() {
            let like = document.querySelectorAll('.comment-like');
            let dislike = document.querySelectorAll('.comment-dislike');

            like.forEach(element => {
                element.addEventListener('click', async function() {
                    const commentLikeCount = element.querySelector('.comment-like-count');
                    const commentLikeIcon = element.querySelector('.comment-like-icon');
                    const loadingIcon = element.querySelector('.loading-icon');
                    const commentId = element.parentElement.parentElement.dataset.commentId;
                    const userRating = element.parentElement.parentElement.querySelector(
                        '#user-rating');

                    const commentDislike = element.nextElementSibling;
                    const commentDislikeIcon = element.nextElementSibling.querySelector(
                        '.comment-dislike-icon');
                    const commentDislikeCount = element.nextElementSibling.querySelector(
                        '.comment-dislike-count');
                    const loadingIcon2 = element.nextElementSibling.querySelector('.loading-icon');

                    commentLikeIcon.classList.add('hidden');
                    loadingIcon.classList.remove('hidden');

                    if (commentDislike.classList.contains('bg-red-200')) {
                        commentDislikeIcon.classList.add('hidden');
                        loadingIcon2.classList.remove('hidden');
                    }


                    if (commentDislike.classList.contains('bg-red-200')) {
                        const res = await Promise.all([
                            updateLikeStatus('/api/comment-likes', {
                                comment_id: commentId,
                                like_type: DISLIKE_TYPE
                            }),
                            updateLikeStatus('/api/comment-likes', {
                                comment_id: commentId,
                                like_type: LIKE_TYPE
                            })
                        ])
                        const {
                            user_rating
                        } = res[1];
                        userRating.textContent = user_rating;
                    } else {
                        const {
                            user_rating
                        } = await updateLikeStatus('/api/comment-likes', {
                            comment_id: commentId,
                            like_type: LIKE_TYPE
                        })
                        userRating.textContent = user_rating;
                    }

                    loadingIcon.classList.add('hidden');
                    commentLikeIcon.classList.remove('hidden');

                    if (commentDislike.classList.contains('bg-red-200')) {
                        loadingIcon2.classList.add('hidden');
                        commentDislikeIcon.classList.remove('hidden');
                    }

                    if (element.classList.contains('bg-green-200')) {
                        commentLikeCount.textContent = parseInt(commentLikeCount.textContent) - 1;

                        element.classList.remove('bg-green-200');
                        element.classList.remove('hover:bg-green-100')
                        element.classList.add('bg-black-100');
                        element.classList.add('hover:bg-green-200');

                        commentLikeCount.classList.remove('text-green-600');
                        commentLikeCount.classList.add('text-gray-900');

                        commentLikeIcon.classList.remove('stroke-green-600');
                        commentLikeIcon.classList.add('stroke-black-500');
                    } else {
                        commentLikeCount.textContent = parseInt(commentLikeCount.textContent) + 1;

                        element.classList.remove('bg-black-100');
                        element.classList.remove('hover:bg-green-200');
                        element.classList.add('bg-green-200');
                        element.classList.add('hover:bg-green-100');

                        commentLikeCount.classList.remove('text-gray-900');
                        commentLikeCount.classList.add('text-green-600');

                        commentLikeIcon.classList.remove('stroke-black-500');
                        commentLikeIcon.classList.add('stroke-green-600');
                    }

                    if (commentDislike.classList.contains('bg-red-200')) {
                        commentDislikeCount.textContent = parseInt(commentDislikeCount.textContent) - 1;

                        commentDislike.classList.remove('bg-red-200');
                        commentDislike.classList.remove('hover:bg-red-100')
                        commentDislike.classList.add('bg-black-100');
                        commentDislike.classList.add('hover:bg-red-200');

                        commentDislikeCount.classList.remove('text-red-600');
                        commentDislikeCount.classList.add('text-gray-900');

                        commentDislikeIcon.classList.remove('stroke-red-600');
                        commentDislikeIcon.classList.add('stroke-black-500');
                    }
                });
            });

            dislike.forEach(element => {
                element.addEventListener('click', async function() {
                    const commentDislikeCount = element.querySelector('.comment-dislike-count');
                    const commentDislikeIcon = element.querySelector('.comment-dislike-icon');
                    const loadingIcon = element.querySelector('.loading-icon');
                    const commentId = element.parentElement.parentElement.dataset.commentId;
                    const userRating = element.parentElement.parentElement.querySelector(
                        '#user-rating');

                    const commentLike = element.previousElementSibling;
                    const commentLikeIcon = element.previousElementSibling.querySelector(
                        '.comment-like-icon');
                    const commentLikeCount = element.previousElementSibling.querySelector(
                        '.comment-like-count');
                    const loadingIcon2 = element.previousElementSibling.querySelector('.loading-icon');

                    commentDislikeIcon.classList.add('hidden');
                    loadingIcon.classList.remove('hidden');

                    if (commentLike.classList.contains('bg-green-200')) {
                        commentLikeIcon.classList.add('hidden');
                        loadingIcon2.classList.remove('hidden');
                    }

                    if (commentLike.classList.contains('bg-green-200')) {
                        const res = await Promise.all([
                            updateLikeStatus('/api/comment-likes', {
                                comment_id: commentId,
                                like_type: LIKE_TYPE
                            }),
                            updateLikeStatus('/api/comment-likes', {
                                comment_id: commentId,
                                like_type: DISLIKE_TYPE
                            })
                        ])
                        const {
                            user_rating
                        } = res[1];
                        userRating.textContent = user_rating;
                    } else {
                        const {
                            user_rating
                        } = await updateLikeStatus('/api/comment-likes', {
                            comment_id: commentId,
                            like_type: DISLIKE_TYPE
                        })
                        userRating.textContent = user_rating;
                    }

                    loadingIcon.classList.add('hidden');
                    commentDislikeIcon.classList.remove('hidden');

                    if (commentLike.classList.contains('bg-green-200')) {
                        loadingIcon2.classList.add('hidden');
                        commentLikeIcon.classList.remove('hidden');
                    }

                    if (element.classList.contains('bg-red-200')) {
                        commentDislikeCount.textContent = parseInt(commentDislikeCount.textContent) - 1;

                        element.classList.remove('bg-red-200');
                        element.classList.remove('hover:bg-red-100')
                        element.classList.add('bg-black-100');
                        element.classList.add('hover:bg-red-200');

                        commentDislikeCount.classList.remove('text-red-600');
                        commentDislikeCount.classList.add('text-gray-900');

                        commentDislikeIcon.classList.remove('stroke-red-600');
                        commentDislikeIcon.classList.add('stroke-black-500');
                    } else {
                        commentDislikeCount.textContent = parseInt(commentDislikeCount.textContent) + 1;

                        element.classList.remove('bg-black-100');
                        element.classList.remove('hover:bg-red-200');
                        element.classList.add('bg-red-200');
                        element.classList.add('hover:bg-red-100');

                        commentDislikeCount.classList.remove('text-gray-900');
                        commentDislikeCount.classList.add('text-red-600');

                        commentDislikeIcon.classList.remove('stroke-black-500');
                        commentDislikeIcon.classList.add('stroke-red-600');
                    }

                    if (commentLike.classList.contains('bg-green-200')) {
                        commentLikeCount.textContent = parseInt(commentLikeCount.textContent) - 1;

                        commentLike.classList.remove('bg-green-200');
                        commentLike.classList.remove('hover:bg-green-100')
                        commentLike.classList.add('bg-black-100');
                        commentLike.classList.add('hover:bg-green-200');

                        commentLikeCount.classList.remove('text-green-600');
                        commentLikeCount.classList.add('text-gray-900');

                        commentLikeIcon.classList.remove('stroke-green-600');
                        commentLikeIcon.classList.add('stroke-black-500');
                    }
                });
            });
        }

        toggleCommentLike()

        function togglePostLike() {
            const postLike = document.querySelector('.post-like');
            const postDislike = document.querySelector('.post-dislike');

            postLike.addEventListener('click', async function() {
                const postLikeIcon = postLike.querySelector('.post-like-icon');
                const postLikeCount = postLike.querySelector('.post-like-count');
                const loadingIcon = postLike.querySelector('.loading-icon');

                const postDislikeIcon = postDislike.querySelector('.post-dislike-icon');
                const postDislikeCount = postDislike.querySelector('.post-dislike-count');
                const loadingIcon2 = postDislike.querySelector('.loading-icon');

                postLikeIcon.classList.add('hidden');
                loadingIcon.classList.remove('hidden');

                if (postDislike.classList.contains('bg-red-200')) {
                    postDislikeIcon.classList.add('hidden');
                    loadingIcon2.classList.remove('hidden');
                }

                const slug = "{{ $post->slug }}";
                if (postDislike.classList.contains('bg-red-200')) {
                    await Promise.all([
                        updateLikeStatus('/api/post-likes', {
                            post_slug: slug,
                            like_type: DISLIKE_TYPE
                        }),
                        updateLikeStatus('/api/post-likes', {
                            post_slug: slug,
                            like_type: LIKE_TYPE
                        })
                    ])
                } else {
                    await updateLikeStatus('/api/post-likes', {
                        post_slug: slug,
                        like_type: LIKE_TYPE
                    })
                }

                loadingIcon.classList.add('hidden');
                postLikeIcon.classList.remove('hidden');

                if (postDislike.classList.contains('bg-red-200')) {
                    loadingIcon2.classList.add('hidden');
                    postDislikeIcon.classList.remove('hidden');
                }

                if (postLike.classList.contains('bg-green-200')) {
                    postLikeCount.textContent = parseInt(postLikeCount.textContent) - 1;

                    postLikeCount.classList.remove('text-green-600');
                    postLikeCount.classList.add('text-gray-900');

                    postLikeIcon.classList.remove('stroke-green-600');
                    postLikeIcon.classList.add('stroke-black-500');
                } else {
                    postLikeCount.textContent = parseInt(postLikeCount.textContent) + 1;

                    postLikeCount.classList.remove('text-gray-900');
                    postLikeCount.classList.add('text-green-600');

                    postLikeIcon.classList.remove('stroke-black-500');
                    postLikeIcon.classList.add('stroke-green-600');
                }

                if (postDislike.classList.contains('bg-red-200')) {
                    postDislikeCount.textContent = parseInt(postDislikeCount.textContent) - 1;

                    postDislikeCount.classList.remove('text-red-600');
                    postDislikeCount.classList.add('text-gray-900');

                    postDislikeIcon.classList.remove('stroke-red-600');
                    postDislikeIcon.classList.add('stroke-black-500');

                    postDislike.classList.remove('bg-red-200')
                    postDislike.classList.remove('hover:bg-red-100')
                }

                postLike.classList.toggle('bg-green-200')
                postLike.classList.toggle('hover:bg-green-100')
            })

            postDislike.addEventListener('click', async function() {
                const postDislikeIcon = postDislike.querySelector('.post-dislike-icon');
                const postDislikeCount = postDislike.querySelector('.post-dislike-count');
                const loadingIcon = postDislike.querySelector('.loading-icon');

                const postLikeIcon = postLike.querySelector('.post-like-icon');
                const postLikeCount = postLike.querySelector('.post-like-count');
                const loadingIcon2 = postLike.querySelector('.loading-icon');

                postDislikeIcon.classList.add('hidden');
                loadingIcon.classList.remove('hidden');

                if (postLike.classList.contains('bg-green-200')) {
                    postLikeIcon.classList.add('hidden');
                    loadingIcon2.classList.remove('hidden');
                }

                const slug = "{{ $post->slug }}";
                if (postLike.classList.contains('bg-green-200')) {
                    await Promise.all([
                        updateLikeStatus('/api/post-likes', {
                            post_slug: slug,
                            like_type: LIKE_TYPE
                        }),
                        updateLikeStatus('/api/post-likes', {
                            post_slug: slug,
                            like_type: DISLIKE_TYPE
                        })
                    ])
                } else {
                    await updateLikeStatus('/api/post-likes', {
                        post_slug: slug,
                        like_type: DISLIKE_TYPE
                    })
                }

                loadingIcon.classList.add('hidden');
                postDislikeIcon.classList.remove('hidden');

                if (postLike.classList.contains('bg-green-200')) {
                    loadingIcon2.classList.add('hidden');
                    postLikeIcon.classList.remove('hidden');
                }

                if (postDislike.classList.contains('bg-red-200')) {
                    postDislikeCount.textContent = parseInt(postDislikeCount.textContent) - 1;

                    postDislikeCount.classList.remove('text-red-600');
                    postDislikeCount.classList.add('text-gray-900');

                    postDislikeIcon.classList.remove('stroke-red-600');
                    postDislikeIcon.classList.add('stroke-black-500');
                } else {
                    postDislikeCount.textContent = parseInt(postDislikeCount.textContent) + 1;

                    postDislikeCount.classList.remove('text-gray-900');
                    postDislikeCount.classList.add('text-red-600');

                    postDislikeIcon.classList.remove('stroke-black-500');
                    postDislikeIcon.classList.add('stroke-red-600');
                }

                if (postLike.classList.contains('bg-green-200')) {
                    postLikeCount.textContent = parseInt(postLikeCount.textContent) - 1;

                    postLikeCount.classList.remove('text-green-600');
                    postLikeCount.classList.add('text-gray-900');

                    postLikeIcon.classList.remove('stroke-green-600');
                    postLikeIcon.classList.add('stroke-black-500');

                    postLike.classList.remove('bg-green-200')
                    postLike.classList.remove('hover:bg-green-100')
                }

                postDislike.classList.toggle('bg-red-200')
                postDislike.classList.toggle('hover:bg-red-100')
            })
        }

        togglePostLike()

        function toggleShowComment() {
            const allReplyButton = document.querySelectorAll('.reply-button');

            allReplyButton.forEach(replyButton => {
                replyButton.addEventListener('click', function() {
                    const commentId = replyButton.parentElement.parentElement.dataset.commentId;
                    const commentForm = replyButton.parentElement.nextElementSibling;
                    replyButton.classList.toggle('bg-blue-300');
                    replyButton.classList.toggle('text-blue-600');
                    commentForm.classList.toggle('hidden');
                })
            })
        }

        toggleShowComment()
    </script>
@endauth
