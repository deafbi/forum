<x-admin-layout>

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-4 lg:space-y-8">
            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
                    <h3 class="flex items-center space-x-2">
                        <svg class="hi-solid hi-user-circle inline-block w-5 h-5 text-indigo-500" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Users</span>
                    </h3>
                </div>

                <div class="p-5 lg:p-6 w-full grow md:flex md:space-x-5">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-2 w-full">
                        @csrf
                        @method('PUT')
                        <div class="space-y-1">
                            <label for="tk-form-layouts-multiple-cards-username" class="font-medium">Avatar link</label>
                            <img class="h-24 w-24 object-cover rounded-md" src="{{ $user->avatar }}" alt="">
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="text" id="tk-form-layouts-multiple-cards-username" name="avatar"
                                value="{{ old('avatar', $user->avatar) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="tk-form-layouts-multiple-cards-username" class="font-medium">Username</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="text" id="tk-form-layouts-multiple-cards-username" name="username"
                                value="{{ old('username', $user->username) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="title" class="font-medium">User title</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="text" id="title" name="title" value="{{ old('title', $user->title) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="tk-form-layouts-multiple-cards-name" class="font-medium">Username colour</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="text" id="tk-form-layouts-multiple-cards-name" name="username_color"
                                value="{{ old('username_color', $user->username_color) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="credit" class="font-medium">Credit</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="number" id="credit" name="credit"
                                value="{{ old('credit', $user->credit) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="post_count" class="font-medium">Post count</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="number" id="post_count" name="post_count"
                                value="{{ old('post_count', $user->post_count) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="topic_count" class="font-medium">Topic count</label>
                            <input
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                type="number" id="topic_count" name="topic_count"
                                value="{{ old('topic_count', $user->topic_count) }}" />
                        </div>
                        <div class="space-y-1">
                            <label for="is_banned" class="font-medium">Banned</label>
                            <select
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                id="is_banned" name="is_banned">
                                <option value="0" {{ old('is_banned', $user->is_banned) == 0 ? 'selected' : '' }}>
                                    Not Banned</option>
                                <option value="1" {{ old('is_banned', $user->is_banned) == 1 ? 'selected' : '' }}>
                                    Banned</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label for="role" class="font-medium">Role</label>
                            <select
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                id="role" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->roles->first()->id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label for="signature" class="font-medium">Signature</label>
                            <textarea
                                class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                id="signature" name="signature">{{ old('signature', $user->signature) }}</textarea>
                        </div>
                        <div class="space-y-1">
                            <label for="groups" class="font-medium">Groups</label>
                            <select class="block w-full" id="groups" name="groups[]" multiple>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ in_array($group->id, $user->groups->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label for="awards" class="font-medium">Awards</label>
                            <select class="block w-full" id="awards" name="awards[]" multiple>
                                @foreach ($awards as $award)
                                    <option value="{{ $award->id }}">{{ $award->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <button type="submit"
                            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                            Update user
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="space-y-4 lg:space-y-8">
            <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
                    <h3 class="font-semibold">
                        All Accounts
                    </h3>
                    <h4 class="text-gray-500 text-sm">
                        Manage all your customers
                    </h4>
                </div>
                <div class="p-5 lg:p-6 grow w-full md:flex md:space-x-5">
                </div>
            </div>
        </div>
    </div>

    <script>
        < script >
            document.addEventListener("DOMContentLoaded", function() {
                // Initialize select2 elements
                $('#groups').select2();
                $('#awards').select2();
            });
    </script>

    </script>

</x-admin-layout>
