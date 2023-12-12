<section class="shadow-md sm:rounded-lg">
    <div class="border rounded-md border-zinc-800">
        <header class="px-4 py-4 bg-transparent rounded-t-md">
            <h2 class="text-lg font-medium text-neutral-200">
                {{ $title }}
            </h2>

            <p class="mt-1 text-sm text-neutral-400">
                {{ $description }}
            </p>
        </header>
        <div class="px-4 py-4 bg-zinc-800/50">
            {{ $slot }}
        </div>
    </div>
</section>
