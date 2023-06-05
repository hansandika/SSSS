<x-app-layout title='Register'>
    <div class="flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg px-8 py-8 space-y-8 bg-white rounded-md shadow">
            <div class="space-y-2">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Register</h2>
                <p class="font-medium text-black-300">Become a member</p>
                <div class="w-full h-0.5 bg-black-300"></div>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-4 rounded-md">
                    <div class="space-y-2">
                        <label for="email-address">Email address <span class="text-red-500">*</span></label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="relative block w-full px-3 py-2 {{ $errors->first('email') ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : 'text-gray-900 placeholder-gray-500 border border-gray-300 focus:ring-leaf focus:border-leaf' }}  rounded-none appearance-none rounded-t-md focus:outline-none focus:z-10 sm:text-sm"
                            placeholder="example@mail.com" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 space-y-2 sm:col-span-3">
                            <label for="password">Password <span class="text-red-500">*</span></label>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="relative block w-full px-3 py-2 {{ $errors->first('password') ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : 'text-gray-900 placeholder-gray-500 border border-gray-300 focus:ring-leaf focus:border-leaf' }} rounded-none appearance-none rounded-b-md focus:outline-none focus:z-10 sm:text-sm"
                                placeholder="at least 7 characters (alphanumeric)" value="{{ old('password') }}">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600"><span
                                        class="font-medium">Oops!</span>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6 space-y-2 sm:col-span-3">
                            <label for="confirm-password">Confirm Password <span class="text-red-500">*</span></label>
                            <input id="confirm-password" name="confirm-password" type="password"
                                autocomplete="confirm-password" required
                                class="relative block w-full px-3 py-2 {{ $errors->first('confirm-password') ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : 'text-gray-900  placeholder-gray-500 border border-gray-300 focus:ring-leaf focus:border-leaf' }} rounded-none appearance-none rounded-b-md focus:outline-none focus:z-10 sm:text-sm"
                                value="{{ old('confirm-password') }}">
                            @error('confirm-password')
                                <p class="mt-2 text-sm text-red-600"><span
                                        class="font-medium">Oops!</span>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="gender">Gender <span class="text-red-500">*</span></label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input id="male" type="radio" value="male" name="gender"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 text-leaf focus:ring-nature">
                                <label for="male" class="ml-2 text-sm font-medium text-gray-900">Male</label>
                            </div>
                            <div class="flex items-center">
                                <input id="female" type="radio" value="female" name="gender"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 text-leaf focus:ring-nature">
                                <label for="female" class="ml-2 text-sm font-medium text-gray-900">Female</label>
                            </div>
                            <div class="flex items-center">
                                <input id="non-binary" type="radio" value="non-binary" name="gender"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 text-leaf focus:ring-nature">
                                <label for="non-binary"
                                    class="ml-2 text-sm font-medium text-gray-900">Non-Binary</label>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 ">
                        <label for="date_of_birth">Date Of Birth <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide type="text" id="date_of_birth" name="date_of_birth"
                                autocomplete="date_of_birth" required
                                class="{{ $errors->first('date_of_birth') ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : 'text-gray-900  placeholder-gray-500 border border-gray-300 focus:ring-leaf focus:border-leaf' }} sm:text-sm rounded-lg block w-full pl-10 p-2.5"
                                placeholder="MM / DD / YYYY" datepicker-format="mm/dd/yyyy"
                                value="{{ old('date_of_birth') }}">
                        </div>
                        @error('date_of_birth')
                            <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <div class="flex items-center">
                            <input id="agreement" name="agreement" type="checkbox"
                                class="w-4 h-4 rounded text-leaf accent-leaf focus:ring-leaf">
                            <label for="agreement" class="block ml-2 text-sm text-gray-900 select-none">Agree with
                                Privacy
                                and Policy
                            </label>
                        </div>
                        @error('agreement')
                            <p class="mt-2 text-sm text-red-600"><span
                                    class="font-medium">Oops!</span>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="relative flex justify-center w-full px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md bg-nature group hover:bg-earth focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-nature">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-leaf group-hover:text-nature" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                    Sign up
                </button>
            </form>
            <div class="w-full h-0.5 bg-black-300 bg-opacity-25"></div>
            <span class="block text-sm font-medium text-center">Already have an account?<a
                    href="{{ route('show.login') }}" class="ml-1 text-nature hover:underline">Log in</a></span>
        </div>
    </div>
</x-app-layout>
