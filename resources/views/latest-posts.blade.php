<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 text-gray-400 uppercase font-bold">
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}">Home</a>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-neutral-500">
                <path fill-rule="evenodd"
                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
            <span>Latest Posts</span>

        </div>
    </div>
    <h1 class="py-4 text-xl font-bold text-white">The lastest posts in the last 24 hours</h1>
    <section class="justify-center w-full">

        <livewire:latest-posts />
    </section>
</x-app-layout>
