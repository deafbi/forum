<x-admin-layout>


    <div class="space-y-4 lg:space-y-8">
        <!-- Card: User Profile -->
        <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
            <!-- Card Header: User Profile -->
            <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
                <h3 class="flex items-center space-x-2">
                    <svg class="hi-solid hi-user-circle inline-block w-5 h-5 text-indigo-500" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Awards</span>
                </h3>
            </div>
            <!-- END Card Header: User Profile -->

            <!-- Card Body: User Profile -->
            <div class="p-5 lg:p-6 grow w-full md:flex md:space-x-5">
                <p class="md:flex-none md:w-1/3 text-gray-500 text-sm mb-5">

                </p>
                <form action="{{ route('admin.awards.update', $award) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6 md:w-1/2">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1">
                        <label class="font-medium">Icon</label>
                        <div class="sm:flex sm:items-center sm:space-x-4 space-y-4 sm:space-y-0">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-300">
                                <svg class="hi-solid hi-user inline-block w-8 h-8" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    type="file" id="photo" name="photo" />
                            </label>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label for="tk-form-layouts-multiple-cards-username" class="font-medium">Name</label>
                        <input
                            class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="text" id="tk-form-layouts-multiple-cards-username" name="award_name" value="{{ $award->award_name }}" />
                    </div>
                    <div class="space-y-1">
                        <label for="tk-form-layouts-multiple-cards-name" class="font-medium">Description</label>
                        <input
                            class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="text" id="tk-form-layouts-multiple-cards-name" name="award_description" value="{{ $award->award_description }}" />
                    </div>
                    <button type="submit"
                        class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                        Update award
                    </button>
                </form>
            </div>
            <!-- END Card Body: User Profile -->
        </div>
        <!-- END Card: User Profile -->
    </div>

</x-admin-layout>
