<x-app-layout title='Login'>
    <div class="flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md px-8 py-8 space-y-8 bg-white rounded-md shadow">
            <div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Login</h2>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4 rounded-md shadow-sm">
                    <div class="space-y-2">
                        <label for="email-address">Email address <span class="text-red-500">*</span></label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-t-md focus:outline-none focus:ring-leaf focus:border-leaf focus:z-10 sm:text-sm"
                            placeholder="example@mail.com">
                    </div>
                    <div class="space-y-2">
                        <label for="password">Password <span class="text-red-500">*</span></label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-b-md focus:outline-none focus:ring-leaf focus:border-leaf focus:z-10 sm:text-sm"
                            placeholder="Enter your Password">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox"
                        class="w-4 h-4 border-gray-300 rounded text-leaf accent-leaf focus:ring-leaf">
                    <label for="remember-me" class="block ml-2 text-sm text-gray-900 select-none">Remember me
                    </label>
                </div>
                <div class="flex flex-col items-center space-y-4">
                    <button type="submit"
                        class="relative flex items-center justify-center w-full px-6 py-3 text-sm font-medium text-white transition border border-transparent rounded-md shadow bg-nature group hover:bg-earth focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-nature">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-leaf group-hover:text-nature" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Sign in
                    </button>
                    <a href="{{ route('provider.login', 'google') }}"
                        class="flex items-center justify-center w-full px-6 py-3 mt-4 font-semibold text-gray-900 transition bg-white border-2 rounded-md shadow outline-none border-black-300 hover:bg-green-100 hover:bg-inherit hover:border-nature focus:outline-none"><svg
                            xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-3 text-gray-900 fill-current"
                            viewBox="0 0 48 48" width="48px" height="48px">
                            <path fill="#fbc02d"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12 s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20 s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                            <path fill="#e53935"
                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039 l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                            </path>
                            <path fill="#4caf50"
                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36 c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                            </path>
                            <path fill="#1565c0"
                                d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571 c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                        </svg>Sign in with Google</a>
                </div>
            </form>
            <div class="w-full h-0.5 bg-black-300 bg-opacity-25"></div>
            <span class="block text-sm font-medium text-center">Don't have an account?<a
                    href="{{ route('show.register') }}" class="ml-1 text-nature hover:underline">Sign
                    up</a></span>

        </div>
    </div>
</x-app-layout>
