<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 mb-4 text-gray-400 uppercase font-bold">
        <div class="flex space-x-2 items-center">
            <a href="{{ route('home') }}">Home</a>
            @if ($user)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 text-neutral-500">
                    <path fill-rule="evenodd"
                        d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <a href="{{ route('profile.show', $user) }}"
                    class="font-bold" style="color: {{ $user->getUsernameColor() }};">{{ $user->username }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 text-neutral-500">
                    <path fill-rule="evenodd"
                        d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-neutral-400">Give reputation to {{ $user->username }}</span>
            @endif
        </div>
    </div>

    <div class="flex-row">
        <div class="bg-[#202020] rounded-md">
            <div class="px-4 py-2 text-neutral-500 font-bold">
                <div class="flex mb-4">
                    <form action="{{ route('users.reputation.store', $user) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="points">Reputation</label>
                            <select
                                class="mt-1 w-full block text-neutral-400 bg-[#151515] border border-neutral-800 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-neutral-700 focus:border-neutral-700 sm:text-sm"
                                name="points" id="points" required>
                                @foreach ($allowedPoints as $point)
                                    <option value="{{ $point }}" {{ $point == 0 ? 'selected' : '' }}>
                                        {{ $point > 0 ? 'Positive' : ($point < 0 ? 'Negative' : 'Neutral') }}
                                        ({{ $point }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="reason">Reason</label>
                            <x-input
                                class="mt-1 w-full block text-neutral-400 bg-[#151515] border border-neutral-800 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-neutral-700 focus:border-neutral-700 sm:text-sm"
                                name="reason" />
                        </div>
                        <button class="inline-flex items-center md:px-4 px-3 md:py-2 py-1 bg-[#252525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#191919] focus:bg-[#191919] active:bg-[#222222] focus:outline-none transition ease-in-out duration-150" type="submit">Give reputation to {{ $user->username }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
