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
            <span>Groups</span>

        </div>
    </div>
    <div class="container">
        <h1 class="text-xl font-bold text-white py-4">Groups</h1>
        <div class="grid grid-cols-5 gap-4">
            @foreach ($groups as $group)
                <div class="bg-[#242424] shadow rounded p-4">
                    <h2 class="font-bold mb-2 text-neutral-400 text-xl">{{ $group->name }}</h2>
                    <img class="w-full h-12 object-contain" src="{{ asset('storage/' . $group->group_avatar) }}"
                        alt="">
                    <p class="font-bold text-neutral-400 py-2">Description: {{ $group->description }}</p>
                    <span class="text-neutral-400 font-bold">Owner: </span>
                    <p class="font-bold" style="color: {{ $group->owner->getUsernameColor() }};">
                        {{ $group->owner->username ?? 'N/A' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
