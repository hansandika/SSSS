<nav class="sticky top-0 flex flex-col justify-between w-12 h-screen overflow-hidden shadow-sm bg-black-100 md:w-60">
    <div class="h-full">
        {{-- Nav Items --}}
        <div class='space-y-2'>
            @foreach ($navItems as $navItem)
                <a href="{{ $navItem['url'] }}"class="flex items-center text-xl p-4 hover:scale-[0.98] transition">
                    <i class="text-lg {{ $navItem['icon'] }} mr-2"></i>
                    <span class='ml-2 leading-none'>{{ $navItem['name'] }}</span>
                </a>
            @endforeach
        </div>
        {{-- Logout --}}
        <div class="flex h-full">
            <a href="/logout" class="flex items-center text-xl p-4 hover:scale-[0.98] transition">
                <i class="mr-2 text-lg uil uil-signout"></i>
                <span class='ml-2 leading-none'>Logout</span>
            </a>
        </div>
    </div>
</nav>
