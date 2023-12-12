<x-app-layout>
    <div class="bg-[#242424] shadow-md py-2 px-4 rounded-md mt-4 mb-4 text-gray-400 uppercase font-bold">
        <div class="flex space-x-2 items-center">
            <a href="{{ route('home') }}">Home</a>
            @if ($user)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 text-neutral-500">
                    <path fill-rule="evenodd"
                        d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <span class="">{{ $user->username }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 text-neutral-500">
                    <path fill-rule="evenodd"
                        d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <span>Report User</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-[#202020] px-4 py-4 rounded-md shadow-md">
            <h1 class="text-neutral-200 font-bold text-xl mb-4">Report "{{ $user->username }}" to the admins</h1>

            <form method="POST" action="{{ route('report.store') }}">
                @csrf
                <input type="hidden" name="reported_user_id" value="{{ $user->id }}">

                <x-input-label for="subject" class="text-neutral-300" :value="__('Reason')" />
                <textarea
                    class="w-full mb-4 mt-1 block text-neutral-400 bg-[#252525] border border-[#303030] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#353535] focus:border-[#353535] sm:text-sm"
                    name="reason" required rows="5"></textarea>
                <button type="submit"
                    class="inline-flex items-center md:px-4 px-3 md:py-2 py-1 bg-[#252525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#191919] focus:bg-[#191919] active:bg-[#222222] focus:outline-none transition ease-in-out duration-150">Report
                    user</button>
            </form>
        </div>
        <div class="bg-[#202020] px-4 py-4 rounded-md shadow-md">
            <h2 class="text-xl text-neutral-200 font-bold">Information</h2>
            <p class="text-neutral-400 font-medium mt-2">Kindly note that we request our users to only report any suspected wrongdoings committed by other users, provided that they have valid reasons to do so. Upon receiving a report, a thorough investigation will be conducted to ascertain the validity of the claims. It is important to understand that if a report is found to be frivolous or baseless, punitive measures may be taken against the reporting user. Therefore, we urge all our users to exercise caution when submitting a report and ensure that it is based on concrete evidence.</p>
        </div>
    </div>




</x-app-layout>
