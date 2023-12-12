<x-app-layout>

    <header class="px-4 py-2 mt-4 mb-4 font-bold text-gray-400 rounded-md shadow-md bg-zinc-800/40 border-zinc-800">
        <nav class="flex items-center space-x-2">
            <a href="{{ route('home') }}">Home</a>
            @if ($user)
                <p>Profile of <span class=""
                        style="color: {{ $user->getUsernameColor() }};">{{ $user->username }}</span>
                </p>
            @endif
        </nav>
    </header>

    @include('partials.flash-messages')

    @if ($user->is_banned)
        <section class="bg-[#191a1e] shadow-md py-2 px-4 rounded-md mt-4 mb-4 text-gray-400 uppercase font-bold">
            <div class="flex items-center space-x-2">
                <span class="text-red-500">This user is banned.</span>
            </div>
        </section>
    @endif


    <div class="flex justify-between border rounded-md shadow-md bg-zinc-800/10 border-zinc-800"
        style="@if ($user->show_cover && $user->cover) background-image: linear-gradient(rgba(32, 32, 32, 0.5), rgba(32, 32, 32, 0.5)), url('{{ $user->cover }}');
            background-color: #202020;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            object-fit: cover;
            width: 100%; @endif
            ">
        <div class="flex items-center p-4 space-x-2 md:space-x-4">
            <img class="rounded-md inline-block text-6xl md:h-32 h-24 md:w-32 w-24 object-cover bg-center overflow-hidden align-bottom {{ $user->hasBeenOnlinePast15Minutes() ? 'online-border' : '' }}"
                src="{{ $user->avatar }}" alt="">
            <div class="flex-row space-y-2">
                <h2 class="text-2xl font-bold md:text-4xl" style="color: {{ $user->getUsernameColor() }};">
                    {{ $user->username }}</h2>
                <p class="font-bold text-gray-300">
                    {{ $user->title }}
                </p>
            </div>
        </div>
        <div class="flex items-center mr-10 space-x-2">

            <a href="{{ route('users.scan', $user) }}"
                class="py-2 border border-[#303030] inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md px-3 bg-zinc-800 text-zinc-400 ring-1 ring-inset ring-zinc-800 hover:bg-zinc-800 hover:text-zinc-300">Scan</a>

            <a href="{{ route('report.create', $user) }}"
                class="py-2 border border-[#303030] inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md px-3 bg-zinc-800 text-zinc-400 ring-1 ring-inset ring-zinc-800 hover:bg-zinc-800 hover:text-zinc-300">Report</a>

            <a href="#"
                class="py-2 border border-[#303030] inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md px-3 bg-zinc-800 text-zinc-400 ring-1 ring-inset ring-zinc-800 hover:bg-zinc-800 hover:text-zinc-300">Send
                message</a>

        </div>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <!-- First col -->
        <div class="flex-row col-span-1">
            <section class="py-5 text-neutral-400">
                <x-block :title="__('User stats')" :description="__('Stats related to the user')">
                    <article class="flex justify-between mb-4">
                        <p class="">Last seen at:</p>
                        <p>{{ $user->last_login_at ? $user->last_login_at : 'Nothing found' }}</p>
                    </article>
                    <article class="flex justify-between mb-4">
                        <p class="flex items-center gap-2">
                            <x-heroicon-s-user class="w-4 h-4 text-neutral-400" />
                            UID
                        </p>
                        <p>{{ $user->id }}</p>
                    </article>
                    <article class="flex justify-between mb-4">
                        <p class="flex items-center gap-2">
                            <x-heroicon-s-cake class="w-4 h-4 text-neutral-400" />
                            Registrated
                        </p>
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                    </article>
                    <article class="flex justify-between mb-4">
                        <p class="flex items-center gap-2">
                            <x-heroicon-s-finger-print class="w-4 h-4 text-neutral-400" />
                            Username history
                        </p>
                        <p>0</p>
                    </article>
                    <article class="flex justify-between mb-4">
                        <p class="flex items-center gap-2">
                            <x-heroicon-s-trophy class="w-4 h-4 text-neutral-400" />
                            Awards
                        </p>
                        <p>{{ $user->awards->count() }}</p>
                    </article>
                    <article class="flex justify-between mb-4">
                        @if ($lastVisitor)
                            <p class="flex items-center gap-2 font-bold">
                                <x-heroicon-s-user class="w-4 h-4 text-neutral-400" />
                                Last visitor:
                            </p>
                            <a href="{{ route('profile.show', $lastVisitor) }}"
                                style="color: {{ $lastVisitor->getUsernameColor() }};">{{ $lastVisitor->username }}</a>
                        @else
                            <p>No visitors yet.</p>
                        @endif
                    </article>
                    <article>
                        <p>Profile views: {{ $profileViews }}</p>
                    </article>
                    @if ($user->discord_id)
                        <article class="flex justify-between mb-4">
                            <p class="flex items-center gap-2">
                                <!-- Discord icon code -->
                                Discord
                            </p>
                            <p>{{ $user->discord_id }}</p>
                        </article>
                    @endif
                    @if ($user->telegram_id)
                        <article class="flex justify-between mb-4">
                            <p class="flex items-center gap-2">
                                <!-- Telegram icon code -->
                                Telegram
                            </p>
                            <p>{{ $user->telegram_id }}</p>
                        </article>
                    @endif
                    @if ($user->btc_address)
                        <article class="flex justify-between mb-4">
                            <p class="flex items-center gap-2">
                                <!-- Btc icon code -->
                                Btc:
                            </p>
                            <p>{{ $user->btc_address }}</p>
                        </article>
                    @endif
                </x-block>
            </section>
            <div class="flex space-x-4">
                <div class="w-full border rounded-md shadow-md bg-zinc-800/10 border-zinc-800">
                    <div class="px-10 py-4 text-center">
                        <span
                            class="font-bold text-2xl {{ $user->totalReputation() > 0 ? 'text-green-600' : ($user->totalReputation() < 0 ? 'text-red-600' : 'text-gray-600') }}">{{ $user->totalReputation() }}</span>
                        <p class="text-lg font-bold text-neutral-500 ">Reputation</p>
                    </div>
                    <div class="flex py-3 justify-evenly bg-zinc-800/60">
                        <!-- Reputation report -->
                        <a href="{{ route('users.reputation.show', $user) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-neutral-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>

                        </a>

                        <!-- Add reputation -->
                        <a href="{{ route('users.reputation.give', $user) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6 text-neutral-500">
                                <path fill-rule="evenodd"
                                    d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                                    clip-rule="evenodd" />
                            </svg>

                        </a>

                        <!-- Reputation given -->
                        <a href="{{ route('users.reputation.given', $user) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-neutral-500"">
                                <path stroke-linecap=" round" stroke-linejoin="round"
                                    d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>

                        </a>
                    </div>
                </div>

                <div class="w-full border rounded-md shadow-md bg-zinc-800/10 border-zinc-800">
                    <div class="px-10 py-4 text-center">
                        <span
                            class="font-bold text-2xl {{ $user->vouches->count() > 0 ? 'text-green-600' : ($user->vouches->count() < 0 ? 'text-red-600' : 'text-gray-600') }}">{{ $user->vouches->count() }}</span>
                        <p class="text-lg font-bold text-neutral-500 ">Vouches</p>
                    </div>
                    <div class="flex py-3 justify-evenly bg-zinc-800/60">
                        <a href="{{ route('users.vouch.show', $user) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-neutral-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>

                        </a>
                        <a href="{{ route('users.vouch.give', $user) }}" x-data="{ open: false }" @click="open = true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-neutral-500"">
                                <path stroke-linecap=" round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                        <a href="{{ route('users.vouch.given', $user) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-neutral-500"">
                                <path stroke-linecap=" round" stroke-linejoin="round"
                                    d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second col -->
        <section class="flex-row col-span-2 py-5 space-y-4">
            <x-block :title="__('Recent activity')" :description="__('Recent activity like posts, topics, reputation and vouch')">
                @forelse ($latestActivities as $activity)
                    @if ($activity instanceof App\Models\Post)
                        <div class="pb-4 space-y-4">
                            <header class="flex items-center space-x-4">
                                <img class="w-12 h-12 rounded-md" src="{{ $activity->user->avatar }}"
                                    alt="">
                                <span
                                    style="color: {{ $activity->user->getUsernameColor() }}">{{ $activity->user->username }}</span>
                                <time class="text-neutral-500">{{ $activity->created_at->diffForHumans() }}</time>
                            </header>
                            <div class="">
                                <a class="font-bold text-neutral-200 hover:text-neutral-400"
                                    href="{{ route('topics.show', ['category' => $activity->topic->category, 'topic' => $activity->topic]) }}">
                                    {{ Str::limit($activity->topic->title, 30) }}
                                </a>
                            </div>
                            <div class="">
                                <p class="text-neutral-400">{{ Str::limit($activity->content, 250) }}</p>
                            </div>
                            <footer
                                class="inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-full bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20 hover:bg-emerald-400/10 hover:text-emerald-300 hover:ring-emerald-300">
                                Post
                            </footer>
                            <hr class="my-1 border rounded-md border-zinc-700">
                        </div>
                    @elseif ($activity instanceof App\Models\Topic)
                        <div class="pb-4 space-y-4">
                            <header class="flex items-center space-x-4">
                                <img class="w-12 h-12 rounded-md" src="{{ $activity->user->avatar }}"
                                    alt="">
                                <span
                                    style="color: {{ $activity->user->getUsernameColor() }}">{{ $activity->user->username }}</span>
                                <time class="text-neutral-500">{{ $activity->created_at->diffForHumans() }}</time>
                            </header>
                            <div class="">
                                <a class="text-neutral-200"
                                    href="{{ route('topics.show', ['category' => $activity->category, 'topic' => $activity]) }}">
                                    <h2 class="font-bold text-neutral-400">{{ Str::limit($activity->title, 30) }}
                                    </h2>
                                </a>
                            </div>
                            <footer
                                class="inline-flex gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-full bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20 hover:bg-emerald-400/10 hover:text-emerald-300 hover:ring-emerald-300">
                                Topic
                            </footer>
                            <hr class="my-1 border rounded-md border-zinc-700">
                        </div>
                    @endif
                @empty
                    <p class="font-bold text-neutral-500">No recent activities.</p>
                @endforelse
            </x-block>
        </section>

        <!-- Third col -->
        <div class="flex-row col-span-1 py-5 space-y-4">
            <x-block :title="__('Awards')" :description="__('All of the users awards')">
                <div class="flex overflow-hidden">
                    <ul class="">
                        @forelse ($user->awards as $award)
                            <li>
                                <img class="w-6 h-6"
                                    src="{{ asset('storage/' . Str::after($award->icon, 'public/')) }}"
                                    alt="">
                            </li>
                    </ul>
                @empty
                    <li class="font-bold text-neutral-500">This user does not have any awards.</li>
                    @endforelse
            </x-block>
            <x-block :title="__('Group(s)')" :description="__('The groups the user is part of')">
                <div class="flex overflow-hidden">
                    <ul>
                        @forelse ($user->groups as $group)
                            <li class="list-none">
                                <img class="object-contain w-full h-12"
                                    src="{{ asset('storage/' . $group->group_avatar) }}" alt="">
                            </li>
                    </ul>
                @empty
                    <li class="font-bold text-neutral-500">This user is not part of any group.</li>
                    @endforelse
                </div>
            </x-block>
        </div>
    </div>
    </div>
</x-app-layout>
