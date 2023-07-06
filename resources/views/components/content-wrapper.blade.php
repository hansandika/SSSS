<div class='flex flex-col min-w-[500px]'>
    <h3 class='py-2 text-2xl font-semibold transition text-black-700'>{{ ucfirst($title) }}</h3>
    <div class='flex flex-col justify-between flex-1 p-3 border-2 rounded border-secondary-dark '>
        <div class='space-y-5'>
            {{ $slot }}
        </div>
        <div class="self-end mt-2 text-right">
            <a href={{ $link }} class='transition text-black-700 hover:underline'>See All
            </a>
        </div>
    </div>
</div>
