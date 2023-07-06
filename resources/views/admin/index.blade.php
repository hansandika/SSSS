<x-app-layout-admin title="Admin Dashboard">
    <div class="flex flex-wrap gap-5">
        <x-content-wrapper title="Users" link="/admin/users">
            <table class='w-full text-left text-black-700'>
                <tbody>
                    <tr class='text-left text-white bg-black-400'>
                        <th class='p-2'>Profile</th>
                        <th class='p-2'>Email</th>
                        <th class='p-2'>Provider</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr class='border-b'>
                            <td class='py-2'>
                                <div class='flex items-center space-x-2'>
                                    <img src="{{ $user->image }}"
                                        class="object-cover w-10 h-10 rounded-full aspect-video" alt="profile-image">
                                    <p>{{ $user['name'] }}</p>
                                </div>
                            </td>
                            <td class='p-2'>{{ $user['email'] }}</td>
                            <td class='p-2'>{{ $user['provider'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-content-wrapper>

        <x-content-wrapper title="Categories" link="/admin/categories">
            <table class='w-full text-left text-black-700'>
                <tbody>
                    <tr class='text-left text-white bg-black-400'>
                        <th class='p-2'>Category ID</th>
                        <th class='p-2'>Category Name</th>
                    </tr>
                    @foreach ($categories as $category)
                        <tr class='border-b'>
                            <td class='p-2'>{{ $category->id }}</td>
                            <td class='p-2'>{{ $category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-content-wrapper>

        <x-content-wrapper title="Posts" link="/admin/posts">
            @foreach ($posts as $post)
                <div>
                    <h1 class='text-lg font-semibold transition text-black-700'>{{ Str::limit($post->title, 50) }}</h1>
                    <p class='text-sm text-black-300'>{{ Str::limit($post->content, 100) }}</p>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('posts.edit', $post->slug) }}"
                            class='transition text-black-700 hover:underline'>
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='transition text-black-700 hover:underline'>Delete</button>
                        </form>
                    </div>
                    <hr class='mt-2' />
                </div>
            @endforeach
        </x-content-wrapper>

        <x-content-wrapper title="Comments" link="/admin/comments">
            @foreach ($comments as $comment)
                <div class='flex space-x-2'>
                    <img src="{{ $comment->user->image }}" class="object-cover w-10 h-10 rounded-full aspect-video"
                        alt="profile-image">
                    <div class='flex-1'>
                        <div class="flex items-center justify-between">
                            <p class='font-semibold transition text-black-700'>
                                {{ $comment->user->name }}</p>
                            <span class='text-sm text-black-400'>
                                commented on {{ $comment->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class='transition text-black-700 line-clamp-3'>{{ $comment->content }}
                        </div>
                        <div class="flex items-center justify-end">
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='transition text-black-700 hover:underline'>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </x-content-wrapper>
    </div>
</x-app-layout-admin>
