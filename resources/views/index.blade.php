<x-app-layout>
    @guest
        <div class="flex items-center justify-center w-full py-24">
            <div class="max-w-2xl">
                <h1 class="mb-4 text-4xl font-bold uppercase text-neutral-300">
                    Relius,</h1>
                <p class="leading-6 text-neutral-500">
                    Here is a nice piece of forum.. Do stuff.
                </p>
                <div class="pt-4 space-x-2">
                    <a class="inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-cyan-400/10 text-cyan-400 ring-1 ring-inset ring-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-300 hover:ring-cyan-300"
                        href="/quickstart">Register<svg viewBox="0 0 20 20" fill="none" aria-hidden="true"
                            class="mt-0.5 h-5 w-5 -mr-1">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                d="m11.5 6.5 3 3.5m0 0-3 3.5m3-3.5h-9"></path>
                        </svg></a>
                    <a class="inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md py-1 px-3 ring-1 ring-inset hover:bg-zinc-900/2.5 text-zinc-400 ring-white/10 hover:bg-white/5 hover:text-white"
                        href="/quickstart">Login</a>
                </div>
            </div>
        </div>
    @endguest
    <div class="px-4 pt-4 mx-auto lg:px-0" x-data="{ containerHeight: 'auto', updateHeight() { this.containerHeight = this.$refs.activeTab.offsetHeight + 'px'; } }" x-init="updateHeight()"
        x-bind:style="'min-height:' + containerHeight">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <div class="col-span-2">
                <livewire:forum-tabs />
            </div>
            <div class="">
                <div class="px-4 pt-4 mb-4 rounded-md shadow-md bh ring-1 ring-white/10">
                    <h2 class="text-xl text-neutral-200">Live tracking</h2>
                    <livewire:crypto-prices />
                </div>
                @if ($onlineAdminsAndModerators->count() > 0)
                    <div class="bg-[#191a1e] rounded-md px-4 mb-4 py-4">
                        <h2 class="mb-2 text-xl text-neutral-200">Staff online</h2>
                        <ul>
                            @foreach ($onlineAdminsAndModerators as $user)
                                <li class="flex">
                                    <div>
                                        <img class="object-cover w-8 h-8 rounded-md" src="{{ $user->avatar }}"
                                            alt="" />
                                    </div>
                                    <a href="{{ route('profile.show', $user) }}" clasS="ml-4 font-bold "
                                        style="style: {{ $user->getUsernameColor() }};">{{ $user->username }};</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <x-block :title="__('Recent posts')" :description="__('The latest 8 new posts')">
                    <livewire:recent-posts />
                </x-block>
            </div>

        </div>

        <section class="py-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex bg-[#191a1e] border border-[#252525] justify-between shadow-md rounded-md px-4 py-4">
                    <div class="flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 text-neutral-200">
                            <path
                                d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 00-1.032-.211 50.89 50.89 0 00-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 002.433 3.984L7.28 21.53A.75.75 0 016 21v-4.03a48.527 48.527 0 01-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979z" />
                            <path
                                d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 001.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0015.75 7.5z" />
                        </svg>

                        <div class="flex-row ml-4">
                            <h2 class="text-2xl font-bold text-neutral-200">{{ App\Models\Topic::count() }}
                            </h2>
                            <p class="text-sm font-bold text-neutral-500">Topics</p>
                        </div>
                    </div>
                </div>
                <div class="flex bg-[#191a1e] border border-[#252525] justify-between shadow-md rounded-md px-4 py-4">
                    <div class="flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 text-neutral-200">
                            <path fill-rule="evenodd"
                                d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97-1.94.284-3.916.455-5.922.505a.39.39 0 00-.266.112L8.78 21.53A.75.75 0 017.5 21v-3.955a48.842 48.842 0 01-2.652-.316c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97z"
                                clip-rule="evenodd" />
                        </svg>


                        <div class="flex-row ml-4">
                            <h2 class="text-2xl font-bold text-neutral-200">{{ App\Models\Post::count() }}
                            </h2>
                            <p class="text-sm font-bold text-neutral-500">Posts</p>
                        </div>
                    </div>
                </div>
                <div class="flex bg-[#191a1e] border border-[#252525] justify-between shadow-md rounded-md px-4 py-4">
                    <div class="flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 text-neutral-200">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>


                        <div class="flex-row ml-4">
                            <h2 class="text-2xl font-bold text-neutral-200">{{ App\Models\User::count() }}
                            </h2>
                            <p class="text-sm font-bold text-neutral-500">Members</p>
                        </div>
                    </div>
                </div>
                <div class="flex bg-[#191a1e] border border-[#252525] justify-between shadow-md rounded-md px-4 py-4">
                    <div class="flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 text-neutral-200">
                            <path
                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                        </svg>


                        <div class="flex-row ml-4">
                            <a href="{{ route('profile.show', $newestMember) }}"
                                class="text-xl font-bold text-neutral-200">{{ Str::limit($newestMember->username, 10) }}
                            </a>
                            <p class="text-sm font-bold text-neutral-500">Newest member</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="py-5">
            <div class="bg-[#191a1e] px-5 py-5 border border-[#252525] rounded-md shadow-md">
                <h3 class="text-neutral-200">Active Users (last 24 hours)</h3>
                <ul class="flex flex-wrap">
                    @php $count = 0; @endphp
                    @forelse ($activeUsers as $user)
                        @if ($count < 100)
                            <li class="mr-2 font-bold" style="color: {{ $user->getUsernameColor() }};"><a
                                    href="{{ route('profile.show', $user) }}">{{ $user->username }}</a></li>
                            @php $count++; @endphp
                        @else
                            <li class="mr-2 font-bold text-neutral-200">... and more</li>
                            @break
                        @endif
                    @empty
                        <li class="text-neutral-400">No active users in the past 24 hours.</li>
                    @endforelse
                </ul>
            </div>
        </section>

    </div>
</x-app-layout>
