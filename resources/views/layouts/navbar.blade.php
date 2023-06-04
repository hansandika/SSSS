<header id="header"
    class="fixed bottom-0 left-0 z-50 w-full bg-white md:static md:top-0 md:bottom-auto md:py-0 md:px-4 lg:p-0">
    <nav class="flex justify-between items-center max-w-4xl h-12 md:h-[4.5rem] md:gap-x-4 mx-6 md:mx-auto">
        <!-- Logo -->
        <a href={{ route('home') }} class="text-xl font-semibold transition text-black-800 hover:text-earth">S.S.S.S</a>

        <!-- Nav Menu -->
        <div id="nav-menu"
            class="pt-8 pb-16 px-6 fixed -bottom-full left-0 w-full rounded-t-3xl shadow-[0_-1px_4px_rgba(0,0,0,0.3)] transition-all md:static md:shadow-none md:w-fit md:mx-auto md:p-0 md:rounded-none duration-150 bg-white md:bg-inherit">
            <ul class="grid grid-cols-3 gap-y-8 gap-x-0 md:flex md:items-center md:gap-x-8">
                @foreach ($navItems as $navItem)
                    <li>
                        <a href={{ $navItem['url'] }}
                            class="flex flex-col items-center font-medium transition text-black-700 hover:text-nature">
                            <i class="text-lg {{ $navItem['icon'] }} md:hidden"></i>
                            {{ $navItem['name'] }}
                        </a>
                    </li>
                @endforeach
                @guest
                    @foreach ($navItemsNotAuth as $navItem)
                        <li class="md:hidden">
                            <a href={{ $navItem['url'] }}
                                class="flex flex-col items-center font-medium transition text-black-700 hover:text-nature">
                                <i class="text-lg {{ $navItem['icon'] }} md:hidden"></i>
                                {{ $navItem['name'] }}
                            </a>
                        </li>
                    @endforeach
                @endguest
                @auth
                    @foreach ($navItemsAuth as $navItem)
                        <li class="md:hidden">
                            <a href={{ $navItem['url'] }}
                                class="flex flex-col items-center font-medium transition text-black-700 hover:text-blue-600">
                                <i class="text-lg {{ $navItem['icon'] }} md:hidden"></i>
                                {{ $navItem['name'] }}
                            </a>
                        </li>
                    @endforeach
                @endauth
            </ul>
            <i id="nav-close"
                class="uil uil-times absolute right-[1.3rem] bottom-2 text-2xl cursor-pointer text-nature hover:text-earth md:hidden">
            </i>
        </div>

        <!-- Nav Menu For Desktop (Sign Up, Profile) -->
        @guest
            <div class="items-center hidden space-x-2 md:flex">
                @foreach ($navItemsNotAuth as $navItem)
                    @if ($navItem['name'] === 'Login')
                        <a href="{{ $navItem['url'] }}" type="button"
                            class="px-3 py-2 mb-2 mr-2 text-sm font-medium text-center transition border rounded-lg text-nature hover:text-white border-nature hover:bg-nature focus:ring-4 focus:outline-none focus:ring-nature"><i
                                class="text-lg {{ $navItem['icon'] }} mr-2"></i>{{ $navItem['name'] }}</a>
                    @else
                        <a href="{{ $navItem['url'] }}" type="button"
                            class="px-3 py-2 mb-2 mr-2 text-sm font-medium text-center text-white transition rounded-lg bg-nature hover:bg-earth focus:outline-none focus:ring-4 focus:ring-earth"><i
                                class="text-lg {{ $navItem['icon'] }} mr-2"></i>{{ $navItem['name'] }}</a>
                    @endif
                @endforeach
            </div>
        @endguest

        <!-- Nav Toggle For smartphone -->
        <div class="text-lg font-medium cursor-pointer text-black-700 hover:text-earth md:hidden" id="nav-toggle">
            <i class="uil uil-apps"></i>
        </div>
    </nav>
</header>

<script>
    const navToggle = document.querySelector('#nav-toggle');
    const navMenu = document.querySelector('#nav-menu');
    const navClose = document.querySelector('#nav-close');

    navToggle.addEventListener('click', () => {
        navMenu.classList.add('bottom-0');
    });

    navClose.addEventListener('click', () => {
        navMenu.classList.remove('bottom-0');
    });
</script>
