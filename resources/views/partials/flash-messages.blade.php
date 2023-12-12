@if (session('success'))
    <div
        class="my-6 flex gap-2.5 rounded-2xl border p-4 leading-6 border-emerald-500/30 bg-emerald-500/5 text-emerald-200 hover:text-emerald-300">
        <svg viewBox="0 0 16 16" aria-hidden="true" class="flex-none w-4 h-4 mt-1 fill-emerald-200/20 stroke-emerald-200">
            <circle cx="8" cy="8" r="8" stroke-width="0"></circle>
            <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 7.75h1.5v3.5">
            </path>
            <circle cx="8" cy="4" r=".5" fill="none"></circle>
        </svg>
        <div class="mt-0 mb-0">
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded md:p-5">
        <div class="flex items-center">
            <svg class="flex-none inline-block w-5 h-5 mr-3 text-red-500 hi-solid hi-x-circle" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
            <h3 class="font-semibold grow">
                {{ session('error') }}
            </h3>
            <button type="button" onclick="this.parentElement.parentElement.remove();"
                class="inline-flex items-center justify-center px-2 py-1 ml-3 space-x-2 text-sm font-semibold leading-5 text-red-600 border border-transparent rounded focus:outline-none hover:text-red-400 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:text-red-600">
                <svg class="inline-block w-5 h-5 hi-solid hi-x" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded md:p-5">
        <div class="flex items-center mb-3">
            <svg class="flex-none inline-block w-5 h-5 mr-3 text-red-500 hi-solid hi-x-circle" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
            <h3 class="font-semibold">
                Please fix the following errors:
            </h3>
        </div>
        <ul class="ml-8 space-y-2 list-inside">
            @foreach ($errors->all() as $error)
                <li class="flex items-center">
                    <svg class="flex-none inline-block w-4 h-4 mr-2 hi-solid hi-arrow-narrow-right" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
