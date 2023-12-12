<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 text-gray-400 uppercase font-bold">
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}">Home</a>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-4 h-4 text-neutral-500">
                <path fill-rule="evenodd"
                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
            <span>Leaderboard</span>

        </div>
    </div>
    <div class="container px-4 mx-auto">
        <h1 class="py-4 mb-4 text-xl text-neutral-200">Leaderboard</h1>
        <div class="grid grid-cols-4 gap-4">
            <x-block title="Topics" description="">
                @foreach ($topTopicUsers as $index => $user)
                    <div class="bg-[#202020] rounded-md shadow-md">
                        <div class="flex items-center py-2 rounded-md">
                            <img class="object-cover w-12 h-12 rounded-md" src="{{ $user->user->avatar }}"
                                alt="" />
                            <div class="flex-row ml-4">
                                <p class="font-bold text-neutral-300">Topics: {{ $user->total }}</p>
                                <div>
                                    <a href="{{ route('profile.show', $user->user) }}" class="font-bold"
                                        style="color: {{ $user->user->getUsernameColor() }};">{{ $user->user->username }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </x-block>

            <x-block title="Posts" description="">
                @foreach ($topPostUsers as $index => $user)
                    <div class="bg-[#202020] rounded-md shadow-md">
                        <div class="flex items-center py-2 rounded-md">
                            <img class="object-cover w-12 h-12 rounded-md" src="{{ $user->user->avatar }}"
                                alt="" />
                            <div class="flex-row ml-4">
                                <p class="font-bold text-neutral-300">Posts: {{ $user->total }}</p>
                                <div>
                                    <a href="{{ route('profile.show', $user->user) }}" class="font-bold"
                                        style="color: {{ $user->user->getUsernameColor() }};">{{ $user->user->username }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </x-block>

            <x-block title="Rep" description="">
                @foreach ($topRepUsers as $index => $user)
                    <div class="bg-[#202020] rounded-md shadow-md px-4 py-5">
                        <div class="flex items-center py-2 rounded-md">
                            <img class="object-cover w-16 h-16 rounded-md" src="{{ $user->user->avatar }}"
                                alt="" />
                            <div class="flex-row ml-4">
                                <p class="font-bold text-neutral-300">Total rep: {{ $user->total }}</p>
                                <div>
                                    <a href="{{ route('profile.show', $user->user) }}" class="font-bold"
                                        style="color: {{ $user->user->getUsernameColor() }};">{{ $user->user->username }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </x-block>

            <x-block title="Vouches" description="">
                @foreach ($topVouchUsers as $index => $user)
                    <div class="bg-[#202020] rounded-md shadow-md px-4 py-5">
                        <div class="flex items-center py-2 rounded-md">
                            <img class="object-cover w-16 h-16 rounded-md" src="{{ $user->user->avatar }}"
                                alt="" />
                            <div class="flex-row ml-4">
                                <p class="font-bold text-neutral-300">Total vouch: {{ $user->total }}</p>
                                <div>
                                    <a href="{{ route('profile.show', $user->user) }}" class="font-bold"
                                        style="color: {{ $user->user->getUsernameColor() }};">{{ $user->user->username }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </x-block>
        </div>
    </div>

</x-app-layout>
