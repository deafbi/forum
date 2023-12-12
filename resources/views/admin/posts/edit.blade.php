<x-admin-layout>

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-4 lg:space-y-8">
            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
                    <h3 class="flex items-center space-x-2">
                        <svg class="hi-solid hi-user-circle inline-block w-5 h-5 text-indigo-500" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Edit post by {{ $post->user->username }}</span>
                    </h3>
                </div>

                <div class="p-5 lg:p-6 grow w-full md:flex md:space-x-5">
                    <p class="md:flex-none text-gray-500 text-sm mb-5">

                    </p>
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6 w-full">
                        @csrf
                        @method('PUT')
                        <div class="space-y-1">
                            <label for="tk-form-layouts-multiple-cards-username" class="font-medium">Content</label>
                            <textarea
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="text" id="tk-form-layouts-multiple-cards-username" rows="10" name="content" value="{{ $post->content }}"
                                placeholder="Content">{{ $post->content }}</textarea>

                        </div>
                        <button type="submit"
                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                            Update post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
