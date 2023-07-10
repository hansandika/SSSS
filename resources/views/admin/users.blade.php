<x-app-layout-admin title="Admin List Users">
    <x-content-wrapper title="Users" link="/admin/users">
        <table class='w-full text-left text-black-700'>
            <tbody>
                <tr class='text-left text-white bg-black-400'>
                    <th class='p-2'>Profile</th>
                    <th class='p-2'>Email</th>
                    <th class='p-2'>Provider</th>
                    <th class="p-2">GLC Verified</th>
                    <th class="p-2">Action</th>
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
                        <td class='p-2'>{{ $user['glc_verified'] == 1 ? 'Yes' : 'No' }}</td>
                        <td class="p-2">
                            <form action="{{ route('admin.users.updateGlcStatus') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">Update
                                    GLC Verified Status</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-content-wrapper>
</x-app-layout-admin>
