<x-app-layout-admin title="Admin List Categories">
    <x-content-wrapper title="Categories" link="/admin/categories">
        <table class='w-full text-left text-black-700'>
            <tbody>
                <tr class='text-left text-white bg-black-400'>
                    <th class='p-2'>Category ID</th>
                    <th class='p-2'>Category Name</th>
                </tr>
                @foreach ($categories as $category)
                    <tr class='border-b'>
                        <td class='p-2'>{{ $category->id }}</td>
                        <td class='p-2'>{{ ucfirst($category->name) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-content-wrapper>
    <a class="fixed z-10 p-3 text-white transition rounded-full shadow-sm bg-black-700 right-10 bottom-10 hover:scale-90"
        href="{{ route('admin.categories.create') }}"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
            viewBox="0 0 1024 1024" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M854.6 288.6L639.4 73.4c-6-6-14.1-9.4-22.6-9.4H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V311.3c0-8.5-3.4-16.7-9.4-22.7zM790.2 326H602V137.8L790.2 326zm1.8 562H232V136h302v216a42 42 0 0 0 42 42h216v494zM544 472c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v108H372c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h108v108c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V644h108c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H544V472z">
            </path>
        </svg>
    </a>
</x-app-layout-admin>
