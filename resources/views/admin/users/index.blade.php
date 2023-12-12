<x-admin-layout>
    <h2 class="text-2xl font-bold py-2 border-b-2 border-gray-200 mb-4 lg:mb-8">
        Users
    </h2>

    @include('partials.flash-messages')

    <!-- Responsive Table Container -->
    <div class="border border-gray-200 rounded overflow-x-auto min-w-full bg-white">
        <!-- Bordered Table -->
        <table class="min-w-full text-sm align-middle whitespace-nowrap">
            <!-- Table Header -->
            <thead>
                <tr class="border-b border-gray-200">
                    <th
                        class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                        Icon
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Username
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Colour
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Topics
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Posts
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Credits
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Reputation
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Vouch
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Last login at
                    </th>
                    <th class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-left">
                        Last login IP
                    </th>
                    <th
                        class="p-3 text-gray-700 bg-gray-100 font-semibold text-sm tracking-wider uppercase text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <!-- END Table Header -->

            <!-- Table Body -->
            <tbody>
                @foreach ($users as $item)
                    <tr class="border-b border-gray-200">
                        <td class="p-3 text-center">
                            <img src="{{ $item->avatar }}" alt="icon" class="inline-block w-12 h-12 rounded-md" />
                        </td>
                        <td class="p-3">
                            <p class="font-medium">
                                {{ $item->username }}
                            </p>
                            <p class="text-neutral-500">
                                @foreach ($item->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </p>
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->username_color }}
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->topics->count() }}
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->posts->count() }}
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->credit }}
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->reputations->count() }}
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->vouches->count() }}
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->last_login_at }}
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $item->last_login_ip }}
                        </td>
                        <td class="p-3 text-center">
                            <a href="{{ route('admin.users.edit', $item->id) }}"
                                class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                                <svg class="hi-solid hi-pencil inline-block w-4 h-4" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('admin.users.destroy', $item->id) }}"
                                class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-red-300 bg-red-200 text-red-800 shadow-sm hover:text-red-800 hover:bg-red-100 hover:border-red-300 hover:shadow focus:ring focus:ring-red-500 focus:ring-opacity-25 active:bg-red-500 active:border-red active:shadow-none">
                                <svg class="hi-solid hi-pencil inline-block w-4 h-4" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                <span>Delete</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- END Table Body -->
        </table>
        <!-- END Bordered Table -->
    </div>
    <!-- END Responsive Table Container -->


</x-admin-layout>
