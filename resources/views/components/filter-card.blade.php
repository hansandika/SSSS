<div class="w-full px-4 py-8 mb-4 space-y-4 bg-white rounded shadow-sm md:mb-0">
    <h4 class="text-xl font-semibold text-black-700">Filter</h4>
    <div class="flex flex-wrap gap-2 md:flex-col">
        @foreach ($categories as $category)
            <a href="?category={{ $category->name }}" type="button"
                class="transition  border  {{ request('category') === $category->name ? 'text-white hover:text-green-700 border-white bg-green-700 hover:bg-white hover:border-green-700' : 'text-green-700 hover:text-white border-green-600 bg-white hover:bg-green-700' }} focus:ring-4 focus:outline-none focus:ring-green-300 rounded-full text-base font-medium px-5 py-2.5 text-center">#{{ $category->name }}</a>
        @endforeach
    </div>
</div>
