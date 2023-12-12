    <!-- Page Sidebar -->
    <nav id="page-sidebar"
        x-bind:class="{
            'flex flex-col fixed top-0 left-0 bottom-0 w-full lg:w-64 h-full bg-[#313947] text-gray-200 z-50 transform transition-transform duration-500 ease-out': true,
            '-translate-x-full': !mobileSidebarOpen,
            'translate-x-0': mobileSidebarOpen,
            'lg:-translate-x-full': !desktopSidebarOpen,
            'lg:translate-x-0': desktopSidebarOpen,
        }"
        aria-label="Main Sidebar Navigation">
        <!-- Sidebar Header -->
        <div class="h-16 bg-gray-600 bg-opacity-25 flex-none flex items-center justify-between lg:justify-center w-full">
            <!-- Brand -->
            <a href="javascript:void(0)"
                class="inline-flex items-center font-bold text-lg tracking-wide text-white-600 hover:text-white-400 text-white hover:opacity-75">
                <span>Admin panel</span>
            </a>
            <!-- END Brand -->

            <!-- Close Sidebar on Mobile -->
            <div class="lg:hidden">
                <button type="button"
                    class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-transparent text-white opacity-75 hover:opacity-100 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:opacity-75"
                    x-on:click="mobileSidebarOpen = false">
                    <svg class="hi-solid hi-x inline-block w-4 h-4 -mx-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <!-- END Close Sidebar on Mobile -->
        </div>
        <!-- END Sidebar Header -->

        <!-- Sidebar Navigation -->
        <div class="overflow-y-auto">
            <div class="p-4 w-full">
                <nav class="space-y-1">
                    <a href="{{ route('admin.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-200 bg-gray-800 bg-opacity-50">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="hi-outline hi-home inline-block w-5 h-5" stroke="currentColor" fill="none"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </span>
                        <span class="py-2 grow">Dashboard</span>
                    </a>
                    <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-400">Forum</div>

                    <div x-data="{ open: false }" class="space-y-1">
                        <a href="javascript:void(0)"
                            class="flex items-center space-x-3 px-3 font-medium rounded relative z-1 text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25"
                            x-on:click="open = !open">
                            <span class="flex-none flex items-center opacity-50">
                                <svg stroke="currentColor" fill="none" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="hi-outline hi-user-circle inline-block w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </span>
                            <span class="py-2 grow">Forum</span>
                            <span x-bind:class="{ 'rotate-90': !open, 'rotate-0': open }"
                                class="transform transition ease-out duration-150 opacity-75 rotate-0">
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                    class="hi-solid hi-chevron-down inline-block w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </a>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform -translate-y-6 opacity-0"
                            x-transition:enter-end="transform translate-y-0 opacity-100"
                            x-transition:leave="transition ease-in duration-100 bg-transparent"
                            x-transition:leave-start="transform translate-y-0 opacity-100"
                            x-transition:leave-end="transform -translate-y-6 opacity-0" class="relative z-0">
                            <a href="{{ route('admin.categories.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Categories</span>
                            </a>
                            <a href="{{ route('admin.topics.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Topics</span>
                            </a>
                            <a href="{{ route('admin.posts.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Posts</span>
                            </a>
                            <a href="{{ route('admin.tags.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Tags</span>
                            </a>
                        </div>
                    </div>
                    <div x-data="{ open: false }" class="space-y-1">
                        <a href="javascript:void(0)"
                            class="flex items-center space-x-3 px-3 font-medium rounded relative z-1 text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25"
                            x-on:click="open = !open">
                            <span class="flex-none flex items-center opacity-50">
                                <svg stroke="currentColor" fill="none" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="hi-outline hi-user-circle inline-block w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </span>
                            <span class="py-2 grow">Static</span>
                            <span x-bind:class="{ 'rotate-90': !open, 'rotate-0': open }"
                                class="transform transition ease-out duration-150 opacity-75 rotate-0">
                                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                    class="hi-solid hi-chevron-down inline-block w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </a>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform -translate-y-6 opacity-0"
                            x-transition:enter-end="transform translate-y-0 opacity-100"
                            x-transition:leave="transition ease-in duration-100 bg-transparent"
                            x-transition:leave-start="transform translate-y-0 opacity-100"
                            x-transition:leave-end="transform -translate-y-6 opacity-0" class="relative z-0">
                            <a href="{{ route('admin.categories.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Banners</span>
                            </a>
                            <a href="{{ route('admin.topics.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Ads</span>
                            </a>
                            <a href="{{ route('admin.posts.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Config</span>
                            </a>
                            <a href="{{ route('admin.tags.index') }}"
                                class="flex items-center space-x-3 px-3 font-medium rounded text-sm ml-8 text-gray-400 hover:text-gray-300 active:text-gray-400">
                                <span class="py-2 grow">Tags</span>
                            </a>
                        </div>
                    </div>



                    <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-400">User Related
                    </div>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path
                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                            </svg>

                        </span>
                        <span class="py-2 grow">Users</span>
                    </a>
                    <a href="{{ route('admin.reputations.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path
                                    d="M6 3a3 3 0 00-3 3v2.25a3 3 0 003 3h2.25a3 3 0 003-3V6a3 3 0 00-3-3H6zM15.75 3a3 3 0 00-3 3v2.25a3 3 0 003 3H18a3 3 0 003-3V6a3 3 0 00-3-3h-2.25zM6 12.75a3 3 0 00-3 3V18a3 3 0 003 3h2.25a3 3 0 003-3v-2.25a3 3 0 00-3-3H6zM17.625 13.5a.75.75 0 00-1.5 0v2.625H13.5a.75.75 0 000 1.5h2.625v2.625a.75.75 0 001.5 0v-2.625h2.625a.75.75 0 000-1.5h-2.625V13.5z" />
                            </svg>

                        </span>
                        <span class="py-2 grow">Reputations</span>
                    </a>
                    <a href="{{ route('admin.vouches.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                    clip-rule="evenodd" />
                            </svg>

                        </span>
                        <span class="py-2 grow">Vouches</span>
                    </a>
                    <a href="{{ route('admin.groups.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                            </svg>
                        </span>
                        <span class="py-2 grow">Groups</span>
                    </a>
                    <a href="{{ route('admin.awards.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z"
                                    clip-rule="evenodd" />
                            </svg>


                        </span>
                        <span class="py-2 grow">Awards</span>
                    </a>
                    <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-400">Permission
                    </div>
                    <a href="{{ route('admin.roles.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                <path fill-rule="evenodd"
                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                    clip-rule="evenodd" />
                            </svg>

                        </span>
                        <span class="py-2 grow">Roles</span>
                    </a>
                    <a href="{{ route('admin.permissions.index') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                            <svg class="inline-block w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                    clip-rule="evenodd" />
                            </svg>

                        </span>
                        <span class="py-2 grow">Permissions</span>
                    </a>
                    <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-400">Quick links
                    </div>
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-3 px-3 font-medium rounded text-gray-300 hover:text-gray-100 hover:bg-gray-800 hover:bg-opacity-50 active:bg-gray-800 active:bg-opacity-25">
                        <span class="flex-none flex items-center opacity-50">
                        </span>
                        <span class="py-2 grow">Return to forum</span>
                    </a>
                </nav>
            </div>
        </div>
        <!-- END Sidebar Navigation -->
    </nav>
    <!-- Page Sidebar -->
