<h2 id="{{ $heading }}">
    <button type="button"
        class="flex items-center justify-between w-full px-4 py-5 font-medium text-left transition border-b text-black-700 border-black-200"
        data-accordion-target="#{{ $body }}" aria-expanded="true" aria-controls="{{ $body }}">
        <span>{{ $question }}</span>
        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
</h2>
<div id="{{ $body }}" class="hidden transition" aria-labelledby="{{ $heading }}">
    <div class="px-4 py-5 border-b border-black-200">
        <div class="mb-2 text-sm text-black-50">{!! nl2br(e($answer)) !!}</div>
    </div>
</div>
