<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 mb-4 text-gray-400 uppercase font-bold">
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-4 h-4 text-neutral-500">
                <path fill-rule="evenodd"
                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
            <a href="{{ route('topics.index', $category) }}" class="">{{ $category->name }}</a>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-4 h-4 text-neutral-500">
                <path fill-rule="evenodd"
                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
            <span class="text-neutral-500">Create topic</span>
        </div>
    </div>

    @include('partials.flash-messages')

    <div class="mb-4">
        <h2 class="text-2xl font-bold text-neutral-200">
            Create a new topic
        </h2>
        <p class="text-neutral-400">
            You can use markdown to format your post. <a href="https://www.markdownguide.org/cheat-sheet/"
                target="_blank" class="text-sky-300">Markdown cheat sheet</a>
        </p>
    </div>
    <form action="{{ route('topics.store', [$category]) }}" method="post">
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        @csrf

        @if (isset($subcategory))
            <input type="hidden" name="subcategory_id" value="{{ $subcategory->id }}">
        @endif

        <div class="mb-4">
            <label class="block font-bold text-neutral-400" for="">Title</label>
            <x-input
                class="mt-1 w-full block text-neutral-400 bg-[#151515] border border-neutral-800 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-neutral-700 focus:border-neutral-700 sm:text-sm"
                name="title" />
        </div>
        <div class="flex items-center gap-4">
            <div class="mb-4">
                <select name="tags" id="tags"
                    class="mt-1 w-32 block text-neutral-400 bg-[#151515] border border-neutral-800 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-neutral-700 focus:border-neutral-700 sm:text-sm">
                    <option value="">Select a tag</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>

            </div>
            @if (Auth::user()->hasRole('admin'))
                <div class="mb-4">
                    <label class="block font-bold text-neutral-400" for="locked">Lock</label>
                    <input type="checkbox" name="locked" id="locked" value="1"
                        class="mt-1 py-2 px-2 block text-neutral-400 bg-[#151515] border border-neutral-800 rounded-md shadow-sm focus:outline-none focus:ring-neutral-700 focus:border-neutral-700 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label class="block font-bold text-neutral-400" for="pinned">Pin</label>
                    <input type="checkbox" name="pinned" id="pinned" value="1"
                        class="mt-1 py-2 px-2 block text-neutral-400 bg-[#151515] border border-neutral-800 rounded-md shadow-sm focus:outline-none focus:ring-neutral-700 focus:border-neutral-700 sm:text-sm">
                </div>
            @endif
        </div>

        <x-textarea rows="15"
            class="w-full rounded-md shadow-md bg-[#151515] border border-neutral-800 text-neutral-200 focus:outline-none focus:ring-neutral-700 focus:border-neutral-700"
            name="content">{{ old('content') }}</x-textarea>
        <div class="pt-4">
            <button type="submit"
                class="inline-flex items-center md:px-4 px-3 md:py-2 py-1 bg-[#252525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#191919] focus:bg-[#191919] active:bg-[#222222] focus:outline-none transition ease-in-out duration-150">
                Create topic
            </button>
        </div>
    </form>


</x-app-layout>
