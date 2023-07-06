<x-app-layout-admin title="Admin List Users">
    <x-content-wrapper title="Users" link="/admin/users">
        <table class='w-full text-left text-black-700'>
            <tbody>
                <tr class='text-left text-white bg-black-400'>
                    <th class='p-2'>Profile</th>
                    <th class='p-2'>Email</th>
                    <th class='p-2'>Provider</th>
                </tr>
                @foreach ($users as $user)
                    <tr class='border-b'>
                        <td class='py-2'>
                            <div class='flex items-center space-x-2'>
                                <img src="{{ $user->image }}" class="object-cover w-10 h-10 rounded-full aspect-video"
                                    alt="profile-image">
                                <p>{{ $user['name'] }}</p>
                            </div>
                        </td>
                        <td class='p-2'>{{ $user['email'] }}</td>
                        <td class='p-2'>{{ $user['provider'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-content-wrapper>
</x-app-layout-admin>
