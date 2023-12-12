<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-4xl mx-auto">
        <x-block :title="__('Account login')" :description="__('Notice: We hash the used IP Address, and we advice to use a VPN.')">

            <form class="mx-auto" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" type="text" name="username" :value="old('username')" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <x-input-label for="password" class="text-neutral-300" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <x-button type="submit">
                        {{ __('Login') }}
                    </x-button>
                </div>
            </form>
        </x-block>
    </div>

</x-guest-layout>
