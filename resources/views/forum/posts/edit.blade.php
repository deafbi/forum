<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 mb-4 text-gray-400 uppercase font-bold">
        <div class="flex space-x-2 items-center">
            <a href="{{ route('home') }}">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-4 h-4 text-neutral-500">
                <path fill-rule="evenodd"
                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
            <span class="text-neutral-500">Edit post</span>
        </div>
    </div>

    <div class="mb-4">
        <h2 class="text-2xl font-bold text-neutral-200">
            Edit post
        </h2>
        <p class="text-neutral-400">
            You can use markdown to format your post. <a href="https://www.markdownguide.org/cheat-sheet/"
                target="_blank" class="text-sky-300">Markdown cheat sheet</a>
        </p>
    </div>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PATCH')
        {{-- <input type="hidden" name="category_id" value="{{ $category->id }}"> --}}
        @if ($isFirstPost)
            <input type="hidden" name="is_first_post" value="1">
            <label for="title" class="block text-sm font-medium text-neutral-400 mb-1">Topic Title</label>
            <input id="title" name="title" type="text" value="{{ old('title', $topic->title) }}" required
                class="w-full mb-4 rounded-md shadow-md bg-[#151515] border border-neutral-800 text-neutral-200 focus:outline-none focus:ring-neutral-700 focus:border-neutral-700">

            @if (auth()->user()->hasRole('admin'))
                <div class="flex space-x-10 py-2">
                    <div class="">
                        <label for="is_hidden" class="inline-flex items-center">
                            <input id="is_hidden" name="is_hidden" type="checkbox" value="1"
                                {{ $topic->is_hidden ? 'checked' : '' }}
                                class="rounded-md border-gray-300 text-sky-600 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-neutral-400">Hide Topic</span>
                        </label>
                    </div>

                    <div class="">
                        <label for="is_hidden" class="inline-flex items-center">
                            <input type="checkbox" name="locked" id="locked" value="1"
                                {{ $topic->locked ? 'checked' : '' }}
                                class="rounded-md border-gray-300 text-sky-600 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-neutral-400">Lock topic</span>
                        </label>
                    </div>

                    <div class="">
                        <label for="pinned" class="inline-flex items-center">
                            <input type="checkbox" name="pinned" id="pinned" value="1"
                                {{ $topic->pinned ? 'checked' : '' }}
                                class="rounded-md border-gray-300 text-sky-600 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-neutral-400">pin topic</span>
                        </label>
                    </div>
                </div>
            @endif
        @endif

        <label for="title" class="block text-sm font-medium text-neutral-400 mt-4 mb-2">Topic Title</label>
        <x-textarea rows="15"
            class="w-full rounded-md shadow-md bg-[#151515] border border-neutral-800 text-neutral-200 focus:outline-none focus:ring-neutral-700 focus:border-neutral-700"
            name="content">{{ $post->content }}</x-textarea>
        <div class="pt-4">
            <button type="submit"
                class="inline-flex items-center md:px-4 px-3 md:py-2 py-1 bg-[#252525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#191919] focus:bg-[#191919] active:bg-[#222222] focus:outline-none transition ease-in-out duration-150">
                @if ($isFirstPost)
                    Update Topic
                @else
                    Update Post
                @endif
            </button>
        </div>
    </form>

</x-app-layout>
