<form action="{{ route('comments.store') }}" method="POST" {{ $attributes->merge(['class' => 'w-full rounded-lg']) }}>
    @csrf
    <input type="hidden" name="post_slug" value="{{ $postSlug }}" />
    @if ($parentId)
        <input type="hidden" name="parent_id" value="{{ $parentId }}" />
    @endif
    <label for="chat" class="sr-only">Your message</label>
    <div class="flex items-center ">
        <textarea id="chat" rows="1" name="content"
            class="overflow-hidden resize-none block mr-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Your message..."></textarea>
        <button type="submit"
            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
            <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                </path>
            </svg>
            <span class="sr-only">Send message</span>
        </button>
    </div>
</form>
