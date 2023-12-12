<x-admin-layout>
    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-4 lg:space-y-8">
            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
                    <h3 class="font-semibold">
                        Topic Settings
                    </h3>
                    <h4 class="text-gray-500 text-sm">
                        Be careful with changing these settings
                    </h4>
                </div>

                <div class="p-5  md:space-x-5">
                    <form action="{{ route('admin.topics.update', $topic->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="space-y-1">
                            <label for="tk-form-layouts-multiple-cards-username" class="font-medium">Name</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="text" id="tk-form-layouts-multiple-cards-username" name="title"
                                value="{{ old('title', $topic->title) }}" />
                        </div>
                        <div class="space-y-1">

                            <label for="font-medium" class="font-medium">slug</label>

                            <input
                                class="w-full block border border-gray-200 rounded px-3 py-2 leading-6 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="text" id="tk-form-layouts-multiple-cards-name" name="slug"
                                value="{{ old('slug', $topic->slug) }}" />
                            <p class="text-sm text-gray-500">
                                Will break links if changed
                            </p>
                        </div>
                        <div class="space-y-1">
                            <label for="pinned" class="font-medium">Pinned</label>
                            <select
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                id="pinned" name="pinned">
                                <option value="0" {{ old('pinned', $topic->pinned) == 0 ? 'selected' : '' }}>False
                                </option>
                                <option value="1" {{ old('pinned', $topic->pinned) == 1 ? 'selected' : '' }}>True
                                </option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label for="locked" class="font-medium">Locked</label>
                            <select
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                id="locked" name="locked">
                                <option value="0" {{ old('locked', $topic->locked) == 0 ? 'selected' : '' }}>False
                                </option>
                                <option value="1" {{ old('locked', $topic->locked) == 1 ? 'selected' : '' }}>True
                                </option>
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label for="hidden" class="font-medium">Hidden</label>
                            <select
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                id="hidden" name="hidden">
                                <option value="0" {{ old('hidden', $topic->hidden) == 0 ? 'selected' : '' }}>False
                                </option>
                                <option value="1" {{ old('hidden', $topic->hidden) == 1 ? 'selected' : '' }}>True
                                </option>
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label for="category_id" class="font-medium">Category</label>
                            <select
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $topic->category->id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label for="view_count" class="font-medium">View Count</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="number" id="view_count" name="view_count"
                                value="{{ old('view_count', $topic->view_count) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="post_count" class="font-medium">Post Count</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="number" id="post_count" name="post_count"
                                value="{{ old('post_count', $topic->post_count) }}" />
                        </div>


                        <button type="submit"
                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                            Update topic
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="space-y-4 lg:space-y-8">
            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
                    <h3 class="font-semibold">
                        All Accounts
                    </h3>
                    <h4 class="text-gray-500 text-sm">
                        Manage all your customers
                    </h4>
                </div>
                <div class="p-5 lg:p-6 grow w-full md:flex md:space-x-5">
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
