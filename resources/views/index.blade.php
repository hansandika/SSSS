<x-app-layout title='Home'>
    <x-search-bar />
    <div class="flex flex-col md:space-x-4 md:flex-row">
        <div class="md:basis-1/4">
            <x-filter-card :categories="$categories" />
        </div>
        <div class="flex flex-wrap items-stretch gap-4 content-stretch md:basis-3/4 min-h-[580px]">
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

    @auth
        <script>
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

            function toggleAllPostLike() {
                const like = document.querySelectorAll('.post-like');
                const dislike = document.querySelectorAll('.post-dislike');

                like.forEach(postLike => {
                    postLike.addEventListener('click', async function() {
                        const postLikeIcon = postLike.querySelector('.post-like-icon');
                        const postLikeCount = postLike.querySelector('.post-like-count');
                        const loadingIcon = postLike.querySelector('.loading-icon');

                        const postDislike = postLike.nextElementSibling;
                        const postDislikeIcon = postLike.nextElementSibling.querySelector(
                            '.post-dislike-icon');
                        const postDislikeCount = postLike.nextElementSibling.querySelector(
                            '.post-dislike-count');
                        const loadingIcon2 = postLike.nextElementSibling.querySelector('.loading-icon');

                        postLikeIcon.classList.add('hidden');
                        loadingIcon.classList.remove('hidden');

                        if (postDislike.classList.contains('bg-red-200')) {
                            loadingIcon2.classList.remove('hidden');
                            postDislikeIcon.classList.add('hidden');
                        }

                        const postSlug = postLike.parentElement.parentElement.parentElement.dataset
                            .postSlug;

                        if (postDislike.classList.contains('bg-red-200')) {
                            await Promise.all([
                                updateLikeStatus('/api/post-likes', {
                                    post_slug: postSlug,
                                    like_type: DISLIKE_TYPE
                                }),
                                updateLikeStatus('/api/post-likes', {
                                    post_slug: postSlug,
                                    like_type: LIKE_TYPE
                                })
                            ])
                        } else {
                            await updateLikeStatus('/api/post-likes', {
                                post_slug: postSlug,
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

                            postDislike.classList.toggle('bg-red-200')
                            postDislike.classList.toggle('hover:bg-red-100')
                        }

                        postLike.classList.toggle('bg-green-200')
                        postLike.classList.toggle('hover:bg-green-100')
                    })
                });

                dislike.forEach(postDislike => {
                    postDislike.addEventListener('click', async function() {
                        const postDislikeIcon = postDislike.querySelector('.post-dislike-icon');
                        const postDislikeCount = postDislike.querySelector('.post-dislike-count');
                        const loadingIcon = postDislike.querySelector('.loading-icon');

                        const postLike = postDislike.previousElementSibling;
                        const postLikeIcon = postDislike.previousElementSibling.querySelector(
                            '.post-like-icon');
                        const postLikeCount = postDislike.previousElementSibling.querySelector(
                            '.post-like-count');
                        const loadingIcon2 = postDislike.previousElementSibling.querySelector(
                            '.loading-icon');

                        postDislikeIcon.classList.add('hidden');
                        loadingIcon.classList.remove('hidden');

                        if (postLike.classList.contains('bg-green-200')) {
                            loadingIcon2.classList.remove('hidden');
                            postLikeIcon.classList.add('hidden');
                        }

                        const postSlug = postDislike.parentElement.parentElement.parentElement.dataset
                            .postSlug;

                        if (postLike.classList.contains('bg-green-200')) {
                            await Promise.all([
                                updateLikeStatus('/api/post-likes', {
                                    post_slug: postSlug,
                                    like_type: LIKE_TYPE
                                }),
                                updateLikeStatus('/api/post-likes', {
                                    post_slug: postSlug,
                                    like_type: DISLIKE_TYPE
                                })
                            ])
                        } else {
                            await updateLikeStatus('/api/post-likes', {
                                post_slug: postSlug,
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

                            postLike.classList.toggle('bg-green-200')
                            postLike.classList.toggle('hover:bg-green-100')
                        }

                        postDislike.classList.toggle('bg-red-200')
                        postDislike.classList.toggle('hover:bg-red-100')
                    })
                })
            }

            toggleAllPostLike()
        </script>
    @endauth
</x-app-layout>
