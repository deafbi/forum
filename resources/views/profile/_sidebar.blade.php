<div class="p-4 rounded-md shadow-md bg-zinc-800/30 sm:rounded-lg">
    <ul class="space-y-2">
        <li class="flex items-center gap-2">
            <x-heroicon-s-user class="w-4 h-4 text-neutral-400" />
            <a href="{{ route('profile.edit') }}" class="font-bold text-neutral-200">Public profile</a>
        </li>
        <li class="flex items-center gap-2">
            <x-heroicon-s-cog-8-tooth class="w-4 h-4 text-neutral-400" />
            <a href="{{ route('profile.account') }}" class="font-bold text-neutral-200">Account</a>
        </li>
    </ul>
</div>
