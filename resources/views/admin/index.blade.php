<x-admin-layout>
    <h2 class="text-2xl font-bold py-2 border-b-2 border-gray-200 mb-4 lg:mb-8">
        Dashboard
    </h2>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white p-4 py-4 overflow-hidden shadow-xl sm:rounded-lg">
            @livewire('user-registration-chart')
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        </div>
    </div>

    <div class="py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="p-5 lg:p-6 grow w-full flex justify-between items-center">
                    <div class="flex justify-center items-center rounded-xl w-16 h-16 bg-indigo-100">
                        <svg class="inline-block w-8 h-8 text-blue-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>

                    </div>
                    <dl class="text-right">
                        <dt class="text-2xl font-semibold">
                            {{ $users }}
                        </dt>
                        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                            Users
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="p-5 lg:p-6 grow w-full flex justify-between items-center">
                    <div class="flex justify-center items-center rounded-xl w-16 h-16 bg-indigo-100">
                        <svg class="inline-block w-8 h-8 text-blue-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path
                                d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                            <path
                                d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                        </svg>

                    </div>
                    <dl class="text-right">
                        <dt class="text-2xl font-semibold">
                            {{ $posts }}
                        </dt>
                        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                            Posts
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="p-5 lg:p-6 grow w-full flex justify-between items-center">
                    <div class="flex justify-center items-center rounded-xl w-16 h-16 bg-indigo-100">
                        <svg class="inline-block w-8 h-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M4.804 21.644A6.707 6.707 0 006 21.75a6.721 6.721 0 003.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.025 4.587 2.674 6.192.232.226.277.428.254.543a3.73 3.73 0 01-.814 1.686.75.75 0 00.44 1.223zM8.25 10.875a1.125 1.125 0 100 2.25 1.125 1.125 0 000-2.25zM10.875 12a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm4.875-1.125a1.125 1.125 0 100 2.25 1.125 1.125 0 000-2.25z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <dl class="text-right">
                        <dt class="text-2xl font-semibold">
                            {{ $topics }}
                        </dt>
                        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                            Topics
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="p-5 lg:p-6 grow w-full flex justify-between items-center">
                    <div class="flex justify-center items-center rounded-xl w-16 h-16 bg-indigo-100">
                        <svg class="inline-block w-8 h-8 text-blue-400" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M3 2.25a.75.75 0 01.75.75v.54l1.838-.46a9.75 9.75 0 016.725.738l.108.054a8.25 8.25 0 005.58.652l3.109-.732a.75.75 0 01.917.81 47.784 47.784 0 00.005 10.337.75.75 0 01-.574.812l-3.114.733a9.75 9.75 0 01-6.594-.77l-.108-.054a8.25 8.25 0 00-5.69-.625l-2.202.55V21a.75.75 0 01-1.5 0V3A.75.75 0 013 2.25z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <dl class="text-right">
                        <dt class="text-2xl font-semibold">
                            {{ $reports }}
                        </dt>
                        <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                            Reports
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
