<x-app-layout-admin title="Admin Create New Category">
    <h1 class="mb-4 text-xl font-semibold text-black-700">Create New Categories</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="max-w-xl mb-4">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
            <input type="text" id="name" name="name"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                placeholder="Category Name" value="{{ old('name') }}" required>
            @error('name')
                <p class="mt-2 text-sm text-red-600"><span class="font-medium">Oops!</span>{{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit"
            class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create
            Category</button>
    </form>
</x-app-layout-admin>
