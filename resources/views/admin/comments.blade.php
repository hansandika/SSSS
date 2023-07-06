<x-app-layout-admin title="Admin List Comments">
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
</x-app-layout-admin>
