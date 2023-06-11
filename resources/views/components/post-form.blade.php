<div class="p-8 rounded shadow-sm bg-black-50">
    <h1 class="text-3xl font-semibold">{{ $action }} Post</h1>
    <form action="{{ $url }}" method="POST" class="space-y-6">
        @csrf
        @if ($method == 'PATCH')
            @method('PATCH')
        @endif
        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
            <input type="text" id="title" name="title"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Post something..." value="{{ old('title', $post->title ?? '') }}" required>
            @error('title')
                <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>{{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Content</label>
            <textarea id="content" rows="8" name="content"
                class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                placeholder="Your message...">{{ old('content', $post->content ?? '') }}</textarea>
            @error('content')
                <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>{{ $message }}
                </p>
            @enderror
        </div>
        <button type="submit"
            class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ $action }}
            Post</button>
    </form>
</div>
