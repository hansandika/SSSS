<x-app-layout title='About Us'>
    <div class="p-6 mb-8 space-y-4 bg-white rounded shadow-sm">
        <h1 class="text-4xl font-semibold text-center text-black-700">About S.S.S.S</h1>
        <span class="block text-lg font-medium text-center text-black-600">S.S.S.S stands for SIT Student Support
            Systems. S.S.S.S is
            a place for
            SIT Students to Share Stories Anonymously.</span>
        <span class="block text-sm text-center text-black-400">S.S.S.S is a new developed apps that made in 2023</span>
    </div>

    <div class="p-6 bg-white rounded shadow-sm">
        <h2 class="text-3xl font-semibold text-center text-black-600">Our Team</h2>
        <span class="block mb-4 text-sm text-center text-black-300">Meet our Team</span>
        <div class="flex flex-wrap items-center justify-center gap-4">
            @foreach ($listMembers as $member)
                <div
                    class="flex flex-col items-center justify-center w-full px-4 py-6 space-y-2 rounded shadow-sm bg-black-50 md:w-auto">
                    <img src="{{ asset('images/' . $member['image']) }}" alt="profile-image"
                        class="object-cover object-center rounded-full w-52 h-52 aspect-video">
                    <span class="block font-semibold text-black-600">{{ $member['name'] }}</span>
                    <span class="block text-sm text-black-300">{{ $member['role'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
