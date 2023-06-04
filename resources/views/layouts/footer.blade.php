<footer class="py-4 shadow-sm bg-black-700">
    <div class="w-full max-w-4xl p-4 mx-auto space-y-2 md:space-y-0 md:flex md:items-center md:justify-between">
        <span class="block text-sm text-center text-black-50">© 2023 <a href="{{ route('home') }}"
                class="hover:underline">S.S.S.S</a>. All Rights Reserved.
        </span>
        <ul
            class="flex flex-col items-center space-y-2 text-sm font-medium md:space-y-0 text-black-50 md:flex-row sm:mt-0">
            @foreach ($footerItems as $footerItem)
                <li>
                    <a href="{{ $footerItem['url'] }}" class="mr-4 hover:underline md:mr-6 ">{{ $footerItem['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</footer>
