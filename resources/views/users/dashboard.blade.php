<x-app-layout title='{{ $user->user_name }} Dashboard'>
    <div class="p-8 bg-white rounded shadow">
        <div class="flex flex-col justify-between gap-8 item-start md:flex-row">
            <div class="basis-full md:basis-1/4">
                <img src="{{ $user->image }}" alt="profile-image" class="object-cover rounded-lg aspect-square">
            </div>
            <div class="flex flex-col basis-full md:basis-3/4 gap-y-4 md:gap-y-2">
                <div class="flex flex-col pt-2 grap-y-2">
                    <h1 class="text-lg font-semibold text-black-700">{{ $user->user_name }}</h1>
                    <span class="block text-sm text-black-400">{{ $user->email }}</span>
                </div>
                <div class="flex flex-col flex-wrap items-start gap-4 md:gap-4 md:flex-row md:items-center">
                    <div class="text-sm transition cursor-pointer gap-x-1 group">
                        <i class="font-semibold text-green-600 uil uil-user"></i>
                        <span class="text-black-700 group-hover:text-green-700">{{ $user->gender }}</span>
                    </div>
                    <div class="text-sm transition cursor-pointer gap-x-1 group">
                        <i class="font-semibold text-green-600 uil uil-envelope-alt"></i>
                        <span class="text-black-700 group-hover:text-green-700">{{ $user->email }}</span>
                    </div>
                    <div class="text-sm transition cursor-pointer gap-x-1 group">
                        <i class="font-semibold text-green-600 uil uil-calendar-alt"></i>
                        <span class="text-black-700 group-hover:text-green-700">Joined
                            {{ $user->created_at->format('d M, Y') }}</span>
                    </div>
                </div>
                <p class="text-xs italic leading-loose text-black-400">
                    {{ $user->biography ?? 'No Description' }}
                </p>
            </div>
        </div>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <div class="flex items-center gap-8">
            <div class="flex items-center space-x-2">
                <i class="text-4xl font-light text-black-300 uil uil-envelope-alt"></i>
                <div class="flex flex-col items-start">
                    <span class="block text-sm font-medium text-black-700">Posts</span>
                    <span class="block text-sm font-medium text-black-500">{{ $user->posts_count }}</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <i class="text-4xl font-light text-black-300 uil uil-comment-message"></i>
                <div class="flex flex-col items-start">
                    <span class="block text-sm font-medium text-black-700">Comments
                    </span>
                    <span class="block text-sm font-medium text-black-500">{{ $user->comments_count }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
