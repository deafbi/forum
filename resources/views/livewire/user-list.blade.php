<div x-data>
    <div class="grid grid-cols-4 gap-4">
        @foreach($users as $member)
        <div class="flex items-center rounded-md space-x-4 bg-[#222222] px-5 py-5">
            <img class="object-cover w-16 h-16 rounded-md" src="{{ $member->avatar }}" alt="" />
            <div class="flex-row">
                <a href="{{ route('profile.show', $member) }}" class="text-neutral-300 font-bold">{{ $member->username }}</a>
                <p class="text-neutral-600 font-bold text-sm">Posts: {{ $member->posts->count() }} : Topics: {{ $member->topics->count() }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
