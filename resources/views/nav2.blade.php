<section class="py-4 shadow-md bg-zinc-800/20">
    <div class="px-4 mx-auto rounded-md max-w-screen-2xl">
        <div class="grid items-center grid-cols-3">
            <div class="">
                <ul class="flex items-center space-x-8 font-bold text-gray-200">
                    <li>
                        <div class="hidden sm:flex sm:items-center">

                            <div class="flex justify-center">
                                <div x-data="{
                                    open: false,
                                    toggle() {
                                        if (this.open) {
                                            return this.close()
                                        }

                                        this.$refs.button.focus()

                                        this.open = true
                                    },
                                    close(focusAfter) {
                                        if (!this.open) return

                                        this.open = false

                                        focusAfter && focusAfter.focus()
                                    }
                                }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                    x-id="['dropdown-button']" class="relative">
                                    <!-- Button -->
                                    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                        :aria-controls="$id('dropdown-button')" type="button"
                                        class="flex items-center gap-2 rounded-md">
                                        Browse

                                        <!-- Heroicon: chevron-down -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <!-- Panel -->
                                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                        x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                        style="display: none;"
                                        class="absolute left-0 mt-2 w-40 rounded-md bg-[#202020] border border-[#252525] shadow-md">
                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828] ">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path
                                                    d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 00-1.032-.211 50.89 50.89 0 00-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 002.433 3.984L7.28 21.53A.75.75 0 016 21v-4.03a48.527 48.527 0 01-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979z" />
                                                <path
                                                    d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 001.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0015.75 7.5z" />
                                            </svg>
                                            <a href="{{ route('home.latest') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Latest posts
                                            </a>
                                        </div>

                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path
                                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                                            </svg>
                                            <a href="{{ route('latest-topics.index') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Latest Topics
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('home.search') }}">Search</a>
                    </li>
                    <li>
                        <a href="{{ route('upgrade.index') }}">Upgrade</a>
                    </li>

                    <li>
                        <div class="hidden sm:flex sm:items-center">

                            <div class="flex justify-center">
                                <div x-data="{
                                    open: false,
                                    toggle() {
                                        if (this.open) {
                                            return this.close()
                                        }

                                        this.$refs.button.focus()

                                        this.open = true
                                    },
                                    close(focusAfter) {
                                        if (!this.open) return

                                        this.open = false

                                        focusAfter && focusAfter.focus()
                                    }
                                }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                    x-id="['dropdown-button']" class="relative">
                                    <!-- Button -->
                                    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                        :aria-controls="$id('dropdown-button')" type="button"
                                        class="flex items-center gap-2 rounded-md">
                                        Logs

                                        <!-- Heroicon: chevron-down -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <!-- Panel -->
                                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                        x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                        style="display: none;"
                                        class="absolute left-0 mt-2 w-40 rounded-md bg-[#202020] border border-[#252525] shadow-md">
                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828] ">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            <a href="{{ route('rep-logs.index') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Rep logs
                                            </a>
                                        </div>

                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path
                                                    d="M16.881 4.346A23.112 23.112 0 018.25 6H7.5a5.25 5.25 0 00-.88 10.427 21.593 21.593 0 001.378 3.94c.464 1.004 1.674 1.32 2.582.796l.657-.379c.88-.508 1.165-1.592.772-2.468a17.116 17.116 0 01-.628-1.607c1.918.258 3.76.75 5.5 1.446A21.727 21.727 0 0018 11.25c0-2.413-.393-4.735-1.119-6.904zM18.26 3.74a23.22 23.22 0 011.24 7.51 23.22 23.22 0 01-1.24 7.51c-.055.161-.111.322-.17.482a.75.75 0 101.409.516 24.555 24.555 0 001.415-6.43 2.992 2.992 0 00.836-2.078c0-.806-.319-1.54-.836-2.078a24.65 24.65 0 00-1.415-6.43.75.75 0 10-1.409.516c.059.16.116.321.17.483z" />
                                            </svg>

                                            <a href="{{ route('vouch-logs.index') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Vouch logs
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="hidden sm:flex sm:items-center">

                            <div class="flex justify-center">
                                <div x-data="{
                                    open: false,
                                    toggle() {
                                        if (this.open) {
                                            return this.close()
                                        }

                                        this.$refs.button.focus()

                                        this.open = true
                                    },
                                    close(focusAfter) {
                                        if (!this.open) return

                                        this.open = false

                                        focusAfter && focusAfter.focus()
                                    }
                                }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                    x-id="['dropdown-button']" class="relative">
                                    <!-- Button -->
                                    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                        :aria-controls="$id('dropdown-button')" type="button"
                                        class="flex items-center gap-2 rounded-md">
                                        Extra

                                        <!-- Heroicon: chevron-down -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <!-- Panel -->
                                    <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                        x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                        style="display: none;"
                                        class="absolute left-0 mt-2 w-40 rounded-md bg-[#202020] border border-[#252525] shadow-md">
                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828] ">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <a href="{{ route('extra.awards') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Awards
                                            </a>
                                        </div>

                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 011.5 10.875v-3.75zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 01-1.875-1.875v-8.25zM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 013 18.375v-2.25z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            <a href="{{ route('extra.groups') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Groups
                                            </a>
                                        </div>
                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path
                                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                                            </svg>
                                            <a href="{{ route('extra.members') }}"
                                                class="flex ml-2 items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Members
                                            </a>
                                        </div>
                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path
                                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                                            </svg>
                                            <a href="{{ route('extra.members') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Staff team
                                            </a>
                                        </div>
                                        <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            <a href="{{ route('extra.leaderboard') }}"
                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                Leaderboard
                                            </a>
                                        </div>
                                        @can('manage_forum')
                                            <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                <a href="{{ route('admin.index') }}"
                                                    class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                    Admin
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex justify-center">
                <a href="{{ route('home') }}">
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.5287 15.9294C21.3687 15.6594 20.9187 15.2394 19.7987 15.4394C19.1787 15.5494 18.5487 15.5994 17.9187 15.5694C15.5887 15.4694 13.4787 14.3994 12.0087 12.7494C10.7087 11.2994 9.90873 9.40938 9.89873 7.36938C9.89873 6.22938 10.1187 5.12938 10.5687 4.08938C11.0087 3.07938 10.6987 2.54938 10.4787 2.32938C10.2487 2.09938 9.70873 1.77938 8.64873 2.21938C4.55873 3.93938 2.02873 8.03938 2.32873 12.4294C2.62873 16.5594 5.52873 20.0894 9.36873 21.4194C10.2887 21.7394 11.2587 21.9294 12.2587 21.9694C12.4187 21.9794 12.5787 21.9894 12.7387 21.9894C16.0887 21.9894 19.2287 20.4094 21.2087 17.7194C21.8787 16.7894 21.6987 16.1994 21.5287 15.9294Z" fill="#77767b"></path> </g></svg>                </a>
            </div>

            <div class="flex justify-end">
                @if (Route::has('login'))
                    <ul class="flex items-center gap-2 font-bold text-gray-200">
                        @auth
                            <li>
                                <div class="hidden ml-2 sm:flex sm:items-center">
                                    <div class="hidden sm:flex sm:items-center">

                                        @livewire('notifications-dropdown')
                                    </div>
                                </div>
                            </li>
                            <li>
                                <x-heroicon-s-chat-bubble-bottom-center class="w-6 h-6 text-neutral-400" />
                            </li>
                            <li>
                                <div class="hidden ml-2 sm:flex sm:items-center">
                                    <div class="hidden sm:flex sm:items-center">

                                        <div class="flex justify-center">
                                            <div x-data="{
                                                open: false,
                                                toggle() {
                                                    if (this.open) {
                                                        return this.close()
                                                    }

                                                    this.$refs.button.focus()

                                                    this.open = true
                                                },
                                                close(focusAfter) {
                                                    if (!this.open) return

                                                    this.open = false

                                                    focusAfter && focusAfter.focus()
                                                }
                                            }"
                                                x-on:keydown.escape.prevent.stop="close($refs.button)"
                                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                                x-id="['dropdown-button']" class="relative">
                                                <!-- Button -->
                                                <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                                    :aria-controls="$id('dropdown-button')" type="button"
                                                    class="flex items-center gap-2 rounded-md shadow">
                                                    <div class="flex items-center space-x-4">
                                                        <img class="object-cover w-10 h-10 rounded-md "
                                                            src="{{ Auth::user()->avatar }}" alt="">
                                                        <div class="flex-row space-y-2">
                                                            <h2 class="font-bold"
                                                                style="color: {{ Auth::user()->getUsernameColor() }};">
                                                                {{ Auth::user()->username }}</h2>
                                                        </div>
                                                    </div>

                                                    <!-- Heroicon: chevron-down -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>

                                                <!-- Panel -->
                                                <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                                    x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                                    style="display: none;"
                                                    class="absolute left-0 mt-2 w-40 rounded-md bg-[#202020] border border-[#252525] shadow-md">
                                                    <div class="flex items-center space-x-2 px-4 hover:bg-[#282828] ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd"
                                                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                        <a href="{{ route('profile.show', Auth::user()) }}"
                                                            class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                            Profile
                                                        </a>
                                                    </div>

                                                    <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd"
                                                                d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                                                                clip-rule="evenodd" />
                                                        </svg>


                                                        <a href="{{ route('profile.edit') }}"
                                                            class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                            Settings
                                                        </a>
                                                    </div>

                                                    <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                                                        <svg class="inline-flex w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M17.2929 14.2929C16.9024 14.6834 16.9024 15.3166 17.2929 15.7071C17.6834 16.0976 18.3166 16.0976 18.7071 15.7071L21.6201 12.7941C21.6351 12.7791 21.6497 12.7637 21.6637 12.748C21.87 12.5648 22 12.2976 22 12C22 11.7024 21.87 11.4352 21.6637 11.252C21.6497 11.2363 21.6351 11.2209 21.6201 11.2059L18.7071 8.29289C18.3166 7.90237 17.6834 7.90237 17.2929 8.29289C16.9024 8.68342 16.9024 9.31658 17.2929 9.70711L18.5858 11H13C12.4477 11 12 11.4477 12 12C12 12.5523 12.4477 13 13 13H18.5858L17.2929 14.2929Z"
                                                                    fill="#656565"></path>
                                                                <path
                                                                    d="M5 2C3.34315 2 2 3.34315 2 5V19C2 20.6569 3.34315 22 5 22H14.5C15.8807 22 17 20.8807 17 19.5V16.7326C16.8519 16.647 16.7125 16.5409 16.5858 16.4142C15.9314 15.7598 15.8253 14.7649 16.2674 14H13C11.8954 14 11 13.1046 11 12C11 10.8954 11.8954 10 13 10H16.2674C15.8253 9.23514 15.9314 8.24015 16.5858 7.58579C16.7125 7.4591 16.8519 7.35296 17 7.26738V4.5C17 3.11929 15.8807 2 14.5 2H5Z"
                                                                    fill="#E5E7EB"></path>
                                                            </g>
                                                        </svg>

                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            <a onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                                href="{{ route('logout') }}"
                                                                class="flex items-center w-full first-of-type:rounded-t-md last-of-type:rounded-b-md py-2.5 text-left text-sm disabled:text-gray-500">
                                                                Logout
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li>
                                <a href="/login">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>
