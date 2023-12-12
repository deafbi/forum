<x-app-layout>
    <nav class="px-4 py-2 mt-4 mb-4 font-bold text-gray-400 rounded-md bg-zinc-800/30">
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}">Home</a>
            @if ($user)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 text-neutral-500">
                    <path fill-rule="evenodd"
                        d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <span class="">Settings</span>
            @endif
        </div>
    </nav>

    @include('partials.flash-messages')

    <main class="mx-auto space-y-6">
        <div class="flex gap-4">
            <!-- Side navigation -->
            <div class="w-1/5">
                @include('profile._sidebar')
            </div>
            <!-- Form content -->
            <section class="w-4/5 space-y-6 ">
                <!-- Profile Avatar section -->
                <x-block :title="__('Profile Avatar')" :description="__('Update your account\'s avatar')">
                    <form action="{{ route('profile.avatar.update') }}" method="post">
                        @csrf
                        @method('PUT')

                        <img class="object-cover w-32 h-32 my-4 rounded-md" src="{{ $user->avatar }}" alt="">

                        <x-input-label :value="__('Direct image url:')" />
                        <x-text-input id="avatarInput" type="text" name="avatar"
                            value="{{ Auth::user()->avatar }}" />

                        <div class="pt-5">
                            <x-button type="submit">
                                Update
                            </x-button>
                        </div>
                    </form>
                    @if ($pastAvatars->count() > 0)
                        <div class="pt-8">
                            <x-input-label :value="__('Past avatars:')" />
                            <span class="text-sm text-neutral-500">Click on the image to copy the link</span>
                            <div class="flex gap-4 mt-2">
                                @foreach ($pastAvatars as $pastAvatar)
                                    <img class="object-cover w-16 h-16 transition-all duration-300 transform rounded-md cursor-pointer opacity-70 hover:opacity-100 hover:scale-110"
                                        src="{{ $pastAvatar->avatar_url }}" alt="Past Avatar"
                                        onclick="copyToClipboard('{{ $pastAvatar->avatar_url }}')">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </x-block>


                <!-- Profile Avatar background section -->
                <x-block :title="__('Profile background')" :description="__('Update your account\'s avatar')">
                    <form action="{{ route('profile.cover.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <x-input-label :value="__('Direct image url:')" />
                        <x-text-input type="text" name="cover" value="{{ Auth::user()->cover }}" />

                        <div class="mt-2">
                            <input type="radio" id="" name="show_cover"
                                value="1" {{ Auth::user()->show_cover ? 'checked' : '' }}>
                            <label class="text-neutral-300" for="">Yes</label>

                            <input type="radio" id="" name="show_cover"
                                value="0" {{ !Auth::user()->show_cover ? 'checked' : '' }}>
                            <label class="text-neutral-300" for="">No</label>
                        </div>
                        <div class="pt-5">
                            <x-button type="submit">
                                Update
                            </x-button>
                        </div>
                    </form>
                </x-block>

                <!-- Profile Avatar background section -->
                <x-block :title="__('Avatar background')" :description="__('Update your account\'s avatar')">
                    <form action="{{ route('profile.avatarbg.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <x-input-label :value="__('Direct image url:')" />
                        <x-text-input type="text" name="avatarbg" value="{{ Auth::user()->avatarbg }}" />
                        <div class="pt-5">
                            <x-button type="submit">
                                Update
                            </x-button>
                        </div>
                    </form>
                </x-block>


                <!-- Profile Stuff section -->
                <x-block :title="__('Profile stuff')" :description="__('Update your profile stuff')">
                    <form action="{{ route('profile.min.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="">
                            <x-input-label :value="__('Usertitle')" />
                            <x-text-input type="text" name="title" value="{{ Auth::user()->title }}" />
                        </div>

                        <div class="pt-5">
                            <x-input-label :value="__('Username colour')" />
                            <x-text-input type="text" name="username_color"
                                value="{{ Auth::user()->username_color }}" />
                        </div>

                        <div class="pt-5">
                            <x-input-label :value="__('Group selection')" />
                            <select id="display_group_id" name="display_group_id"
                                class="mt-1 block text-neutral-400 bg-[#252525] border border-[#303030] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#353535] focus:border-[#353535] sm:text-sm w-full ">
                                <option value="">Select a group</option>
                                @foreach (Auth::user()->groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ Auth::user()->display_group_id == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-5">
                            <label class="mt-4 text-neutral-300">{{ __('Show Displayed Group') }}</label>
                            <div class="mt-2">
                                <input type="radio" id="show_displayed_group_yes" name="show_displayed_group"
                                    value="1" {{ Auth::user()->show_displayed_group ? 'checked' : '' }}>
                                <label class="text-neutral-300" for="show_displayed_group_yes">Yes</label>

                                <input type="radio" id="show_displayed_group_no" name="show_displayed_group"
                                    value="0" {{ !Auth::user()->show_displayed_group ? 'checked' : '' }}>
                                <label class="text-neutral-300" for="show_displayed_group_no">No</label>
                            </div>
                        </div>

                        <div class="pt-5">
                            <x-button type="submit">
                                Update
                            </x-button>
                        </div>
                    </form>
                </x-block>

                <!-- Update Signature section -->
                <x-block :title="__('Signature')" :description="__('Please do not update to anything disturbing')">
                    <form action="{{ route('profile.signature.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <textarea
                            class="flex w-full items-center md:px-4 px-3 md:py-2 py-1 bg-[#252525] border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-[#191919] focus:bg-[#191919] active:bg-[#222222] focus:outline-none transition ease-in-out duration-150"
                            name="signature" id="" cols="30" rows="10">{{ $user->signature }}</textarea>
                        <div class="pt-5">
                            <x-button type="submit">
                                Update
                            </x-button>
                        </div>
                    </form>
                </x-block>
            </section>
        </div>
    </main>

    <script>
        function copyToClipboard(text) {
            // Set the input field's value
            const avatarInput = document.getElementById('avatarInput');
            avatarInput.value = text;

            // Apply a temporary class to highlight the input field
            avatarInput.classList.add('border-emerald-500');

            // Remove the temporary class after a short moment
            setTimeout(() => {
                avatarInput.classList.remove('border-emerald-500');
            }, 1000);
        }
    </script>
</x-app-layout>
