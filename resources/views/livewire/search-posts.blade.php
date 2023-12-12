<div class="pt-4">
    <div class="mb-4">
        <x-input-label class="text-neutral-300" for="search" :value="__('Search topics')" />
        <x-text-input id="search" class="block mt-1 w-full" type="search" wire:model.lazy="search" required autofocus />
    </div>

    <ul>
        @foreach($topics as $topic)
        <li class="bg-[#252525] px-4 py-4 mb-4 text-neutral-400 rounded-md border border-[#303030]">
            <div class="flex items-center">
                <img class="object-cover w-8 h-8 rounded-md mr-4" src="{{ asset('/storage/' . $topic->user->avatar) }}" alt="" />
                <a href="{{ route('topics.show', [$topic->category, $topic]) }}" class="font-bold">{{ $topic->title }}</a>
            </div>
            <div class="text-sm">
                <a href="{{ route('profile.show', $topic->user) }}" class="text-neutral-300" style="color: {{ $topic->user->getUsernameColor() }};">{{ $topic->user->username }}</a>
                <span class="text-neutral-500">- {{ $topic->created_at->diffForHumans() }}</span>
            </div>
            <div class="text-sm">
                <span>{{ $topic->post_count }} replies</span>
                <span class="ml-2">{{ $topic->view_count }} views</span>
            </div>
        </li>
        @endforeach
    </ul>

    <div wire:loading>
        <p class="text-neutral-300">Searching...</p>
    </div>

    @if ($topics instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $topics->links() }}
    @endif
</div>
