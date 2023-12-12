<x-app-layout>
    <div class="bg-[#242424] py-2 px-4 rounded-md mt-4 text-gray-400 uppercase font-bold">
        <div class="flex space-x-2 items-center">
            <a href="{{ route('home') }}">Home</a>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-4 h-4 text-neutral-500">
                <path fill-rule="evenodd"
                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
            <span>Upgrade</span>

        </div>
    </div>
    <div class="p-4 md:p-5 rounded mx-auto max-w-4xl mb-10 text-emerald-700 bg-emerald-100 mt-4">
        <div class="flex items-center mb-2">
            <svg class="hi-solid hi-check-circle inline-block w-5 h-5 mr-3 flex-none text-emerald-500"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
            <h3 class="font-semibold">You're upgradable</h3>
        </div>
        <p class="ml-8">
            To upgrade your account, you need to contact an administrator. You can do this by sending a message to <a
                href="#" class="text-emerald-500 hover:text-emerald-600">Panda</a>
        </p>
    </div>
    <div class="grid grid-cols-2 gap-4 max-w-4xl mx-auto">
        <div class="">
            <div class="bg-[#242424] rounded-lg shadow-md py-10 px-10 text-neutral-300">
                <div class="text-center mb-10">
                    <img class="mx-auto" src="{{ asset('storage/' . $upgrade1->image) }}" alt="{{ $upgrade1->name }}">
                    <h2 class="text-3xl font-bold text-yellow-300">{{ $upgrade1->name }}</h2>
                    <p class="text-2xl font-bold">$12.00</p>
                </div>
                <ul class="text-neutral-400">
                    <li class="flex justify-between">
                        <div class="flex items-center gap-2">
                            <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Username color
                        </div>
                        <span class="text-yellow-300 font-bold">{{ Auth::user()->username }}</span>
                    </li>
                    <li class="flex justify-between">
                        <div class="flex items-center gap-2">
                            <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Reputation Power
                        </div>
                        <span class="text-neutral-400">+3/-3</span>
                    </li>
                    <hr class="h-px border border-neutral-700 my-4">
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Post in Marketplace
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Access to website Database
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Change username and title
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Change signature
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Profile banner
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Profile background
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Custom group hue
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-x-circle class="w-4 h-4 text-red-400" /> Profile Picture Glow
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-x-circle class="w-4 h-4 text-red-400" /> Change Username/Rep/Vouch/Vouch color
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-x-circle class="w-4 h-4 text-red-400" /> Post background
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> 5000 Credits
                    </li>
                </ul>
                <div class="flex items-center pt-4">
                    <p class="text-center">To upgrade contact admin</p>
                </div>
            </div>
            <div class="w-60 pt-4 mx-auto">
                <div class="bg-[#242424] py-4 rounded-lg shadow-md">
                    <tbody>
                        <tr class="flex mx-auto">
                            <!-- User Profile -->
                            <td
                                class="w-52 mx-auto table-cell text-center bg-[#202020] border-t border-l border-neutral-800">
                                <!-- username -->
                                <p class="pt-5 ">
                                <div class="flex-row text-center">
                                    <a href="#" class="font-bold text-2xl overflow-hidden text-yellow-300 text-center relative">
                                        {{ Auth::user()->username }}
                                        <img src="https://i.imgur.com/lbPOgse.gif" alt="Image GIF"
                                            class="absolute -top-3 left-0">
                                    </a>

                                </div>

                                </p>
                                <!-- avatar -->
                                <p class="py-5 text-center">
                                    <a href="#">
                                        <img src="{{ Auth::user()->avatar }}"
                                            class="rounded-md inline-block text-6xl h-40 w-40 object-cover bg-center overflow-hidden align-bottom"
                                            alt="username">
                                    </a>
                                </p>

                                <!-- user roles -->
                                <div class="mb-4 flex space-x-4 justify-evenly px-8">
                                    <div>
                                        <span
                                            class="font-bold text-xl text-green-600">{{ Auth::user()->totalReputation() }}</span>
                                        <p class="text-xs font-bold text-neutral-500">Rep</p>
                                    </div>

                                    <div class="text-center">
                                        <span
                                            class="font-bold text-xl text-green-600">{{ Auth::user()->vouches->count() }}</span>
                                        <p class="text-xs font-bold text-neutral-500">Vouches</p>
                                    </div>
                                </div>

                                <!-- user groups... -->
                                <div class="mb-4 flex justify-center">

                                    <img class="mx-auto" src="{{ asset('storage/' . $upgrade1->image) }}"
                                        alt="{{ $upgrade1->name }}">


                                </div>
                                <!-- user replies -->
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="font-bold">
                                            Posts:
                                        </span>
                                        <span>
                                            {{ Auth::user()->post_count }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="">
                                            Threads:
                                        </span>
                                        <span>
                                            {{ Auth::user()->topic_count }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div
                                        class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="font-bold">
                                            Joined:
                                        </span>
                                        <span>
                                            {{ Auth::user()->created_at->format('M Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div
                                        class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="font-bold">
                                            Credits:
                                        </span>
                                        <span>
                                            {{ Auth::user()->credit }}
                                        </span>
                                    </div>
                                </div>
                                @if (Auth::user()->awards->count() > 0)
                                    <div class="px-4 text-neutral-500 mb-2">
                                        <div
                                            class="grid grid-cols-5 px-4 py-2 text-sm font-bold rounded bg-[#1B1B1B] justify-center">
                                            @foreach (Auth::user()->awards as $award)
                                                <img src="{{ asset('/storage/' . $award->award_icon) }}" class="w-6 h-6"
                                                    alt="{{ $award->name }}">
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <!-- User Profile End -->
                            <!-- User Post -->
                        </tr>
                    </tbody>
                </div>
            </div>
        </div>
        <div class="">
            <div class="bg-[#242424] rounded-lg shadow-md py-10 px-10 text-neutral-300">
                <div class="text-center mb-10">
                    <img class="mx-auto" src="{{ asset('storage/' . $upgrade2->image) }}"
                        alt="{{ $upgrade2->name }}">
                    <h2 class="text-3xl font-bold text-[#70d7ea]">{{ $upgrade2->name }}</h2>
                    <p class="text-2xl font-bold">$30.00</p>
                </div>
                <ul class="text-neutral-400">
                    <li class="flex justify-between">
                        <div class="flex items-center gap-2">
                            <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Username color
                        </div>
                        <span class="text-[#70d7ea] font-bold">{{ Auth::user()->username }}</span>
                    </li>
                    <li class="flex justify-between">
                        <div class="flex items-center gap-2">
                            <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Reputation Power
                        </div>
                        <span class="text-neutral-400">+5/-5</span>
                    </li>
                    <hr class="h-px border border-neutral-700 my-4">
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Post in Marketplace
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Access to website Database
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Change username and title
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Change signature
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Profile banner
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Profile background
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Custom group hue
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Profile Picture Glow
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Change Username/Rep/Vouch/Vouch
                        color
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> Post background
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-s-check-circle class="w-4 h-4 text-sky-400" /> 10000 Credits
                    </li>
                </ul>
                <div class="flex items-center pt-4">
                    <p class="text-center">To upgrade contact admin</p>
                </div>
            </div>
            <div class="w-60 pt-4 mx-auto">
                <div class="bg-[#242424] py-4 rounded-lg shadow-md">
                    <tbody>
                        <tr class="flex mx-auto">
                            <!-- User Profile -->
                            <td
                                class="w-52 mx-auto table-cell text-center bg-[#202020] border-t border-l border-neutral-800">
                                <!-- username -->
                                <p class="pt-5 ">
                                <div class="flex-row text-center">
                                    <a href="#" class="font-bold text-2xl overflow-hidden text-center relative text-[#70d7ea]">
                                        {{ Auth::user()->username }}
                                        <img src="https://i.imgur.com/lbPOgse.gif" alt="Image GIF"
                                            class="absolute -top-3 left-0">
                                    </a>

                                </div>

                                </p>
                                <!-- avatar -->
                                <p class="py-5 text-center">
                                    <a href="#">
                                        <img src="{{ Auth::user()->avatar }}"
                                            class="rounded-md inline-block text-6xl h-40 w-40 object-cover bg-center overflow-hidden align-bottom"
                                            alt="username">
                                    </a>
                                </p>

                                <!-- user roles -->
                                <div class="mb-4 flex space-x-4 justify-evenly px-8">
                                    <div>
                                        <span
                                            class="font-bold text-xl text-green-600">{{ Auth::user()->totalReputation() }}</span>
                                        <p class="text-xs font-bold text-neutral-500">Rep</p>
                                    </div>

                                    <div class="text-center">
                                        <span
                                            class="font-bold text-xl text-green-600">{{ Auth::user()->vouches->count() }}</span>
                                        <p class="text-xs font-bold text-neutral-500">Vouches</p>
                                    </div>
                                </div>

                                <!-- user groups... -->
                                <div class="mb-4 flex justify-center">

                                    <img class="mx-auto" src="{{ asset('storage/' . $upgrade2->image) }}"
                                        alt="{{ $upgrade2->name }}">


                                </div>
                                <!-- user replies -->
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div
                                        class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="font-bold">
                                            Posts:
                                        </span>
                                        <span>
                                            {{ Auth::user()->post_count }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div
                                        class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="">
                                            Threads:
                                        </span>
                                        <span>
                                            {{ Auth::user()->topic_count }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div
                                        class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="font-bold">
                                            Joined:
                                        </span>
                                        <span>
                                            {{ Auth::user()->created_at->format('M Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 text-neutral-500 mb-2">
                                    <div
                                        class="px-4 py-1 text-sm font-bold flex  rounded bg-[#1B1B1B] justify-between">
                                        <span class="font-bold">
                                            Credits:
                                        </span>
                                        <span>
                                            {{ Auth::user()->credit }}
                                        </span>
                                    </div>
                                </div>
                                @if (Auth::user()->awards->count() > 0)
                                    <div class="px-4 text-neutral-500 mb-2">
                                        <div
                                            class="grid grid-cols-5 px-4 py-2 text-sm font-bold rounded bg-[#1B1B1B] justify-center">
                                            @foreach (Auth::user()->awards as $award)
                                                <img src="{{ asset('/storage/' . $award->award_icon) }}" class="w-6 h-6"
                                                    alt="{{ $award->name }}">
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <!-- User Profile End -->
                            <!-- User Post -->
                        </tr>
                    </tbody>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
