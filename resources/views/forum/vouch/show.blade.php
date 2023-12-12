<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 mb-4 text-gray-400 uppercase font-bold">
        <div class="flex items-center space-x-2">
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
                <span class="text-neutral-400">Vouch history</span>
            @endif
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="flex-row">
            <div class="bg-[#202020] rounded-md">
                <div class="px-4 py-2 font-bold text-neutral-500">
                    <div class="flex justify-between mb-4">
                        <p>Vouches</p>
                        <p>{{ $user->vouchesReceived->count() }}</p>
                    </div>
                    <div class="flex justify-between mb-4">
                        <p>Positives</p>
                        <p>{{ $user->vouchesReceived->where('type', 'positive')->count() }}</p>
                    </div>
                    <div class="flex justify-between mb-4">
                        <p> Negatives</p>
                        <p>{{ $user->vouchesReceived->where('type', 'negative')->count() }}</p>
                    </div>
                    <div class="flex justify-between mb-4">
                        <p>Neutrals</p>
                        <p>{{ $user->vouchesReceived->where('type', 'neutral')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-row col-span-2">
            <div class="bg-[#202020] rounded-md ">
                @forelse($vouchData as $reputation)
                    <div class="flex items-center px-5 py-5 rounded-md">
                        <div class="bg-[#282828] rounded-md px-4 py-1">
                            <span class="font-bold text-green-400">({{ $reputation->points }})</span>
                        </div>
                        <div class="flex-row ml-4">
                            <a href="#"
                                class="font-bold" style="color: {{ $reputation->vouchedByUser->getUsernameColor() }};">{{ $reputation->vouchedByUser->username }}
                                - <span
                                    class="text-neutral-500">{{ $reputation->created_at->diffForHumans() }}</span></a>
                            <div>
                                <span class="font-bold text-neutral-400">{{ $reputation->reason }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex items-center px-5 py-5 rounded-md">
                        <div class="flex-row ml-4">
                            <span class="text-neutral-500">No vouch history found.</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
