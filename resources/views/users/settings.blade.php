<x-app-layout title='Settings Account'>
    <h1 class="mb-4 text-xl font-semibold text-white">Profile Settings</h1>
    <div class="p-8 bg-white rounded shadow">
        <h3 class="text-lg font-medium text-black-700">Account Information</h3>
        <span class="block text-sm text-black-400">Update your account's profile information and email address.</span>
        <hr class="h-px my-8 bg-gray-200 border-0">
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @method('patch')
            @csrf
            <div class="flex flex-col items-start gap-4 md:items-center md:flex-row">
                <label class="text-black-700 w-44">Email</label>
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                            </path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <input type="text" id="email" disabled
                        class="block w-full p-3 pl-10 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="name@flowbite.com" value="{{ $user->email }}">
                </div>
            </div>
            <div class="flex flex-col items-start gap-4 md:items-center md:flex-row">
                <label class="text-black-700 w-44" for="name">Name</label>
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                            viewBox="0 0 24 24" id="letter-english-a">
                            <path
                                d="M18.97021,19.75732,15.34912,5.27246A2.9958,2.9958,0,0,0,12.43848,3h-.877A2.9958,2.9958,0,0,0,8.65088,5.27246L5.02979,19.75732a1.0001,1.0001,0,0,0,1.94042.48536L8.28082,15h7.43836l1.31061,5.24268a1.0001,1.0001,0,0,0,1.94042-.48536ZM8.78082,13l1.81049-7.24219A.99825.99825,0,0,1,11.56152,5h.877a.99825.99825,0,0,1,.97021.75781L15.21918,13Z">
                            </path>
                        </svg>
                    </div>
                    <input type="text" id="name" name="name" autocomplete="name"
                        class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="name" value="{{ $user->user_name }}">
                </div>
            </div>
            <div class="flex flex-col items-start gap-4 md:items-center md:flex-row">
                <label class="text-black-700 w-44">Date Of Birth</label>
                <div class="relative flex-1">
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
                        class="{{ $errors->first('date_of_birth') ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : 'text-gray-900  placeholder-gray-500 border border-gray-300 focus:ring-blue-500 focus:border-blue-500' }} sm:text-sm rounded-lg block w-full pl-10 p-3"
                        placeholder="MM / DD / YYYY"
                        value="{{ old('date_of_birth', $user->date_of_birth ? date('m/d/Y', strtotime($user->date_of_birth)) : date('m/d/Y', time())) }}">
                </div>
                @error('date_of_birth')
                    <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col items-start gap-4 md:items-center md:flex-row">
                <span class="text-black-700 w-44">Description</span>
                <textarea id="biography" rows="4" name="biography"
                    class="flex-1 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Your message...">{{ old('biography', $user->biography ?? '') }}</textarea>
                @error('biography')
                    <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>{{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col items-start gap-4 md:items-center md:flex-row">
                <label class="text-black-700 w-44">Gender</label>
                <select id="gender" name="gender"
                    class="flex-1 text-gray-900 placeholder-gray-500 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg block w-full p-2.5">
                    <option disabled selected>-- Select Gender Type --</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender }}" @if (strcasecmp($gender, $user->gender) === 0) selected @endif>
                            {{ ucfirst($gender) }}</option>
                    @endforeach
                </select>
                @error('gender')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">Oops!</span>{{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col items-start gap-4 md:items-center md:flex-row">
                <label class="text-black-700 w-44">Avatar</label>
                <div class="flex items-center justify-center flex-1 w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-start justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer h-52 md:h-64 md:items-center bg-gray-50">
                        <div class="flex flex-col items-start justify-center pt-5 pb-6 md:items-center">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500">
                                <span class="font-semibold">Click
                                    to upload</span>
                                or drag and drop
                            </p>
                            <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" name="avatar"
                            accept="image/png, image/gif, image/jpeg, image/svg, image/jpg" />
                    </label>
                </div>
            </div>
            <button type="submit"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"><i
                    class="mr-1 uil uil-save"></i> Save Changes</button>
        </form>
    </div>
</x-app-layout>
