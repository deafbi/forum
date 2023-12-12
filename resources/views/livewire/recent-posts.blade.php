<div>
    @foreach ($recentPosts as $post)
        <div class="flex items-center rounded-md py-2">
            <img class="object-cover w-8 h-8 rounded-md" src="{{ $post->user->avatar }}"
                alt="" />
            <div class="flex-row ml-4">
                {{-- @if ($post->topic->tags && $post->topic->tags->count() > 0)
                    @foreach ($post->topic->tags as $tag)
                        <span class="text-[{{ $tag->color }}] font-bold text-sm">{{ $tag->name }}</span>
                    @endforeach
                @endif --}}
                <a href="{{ route('topics.show', [$post->topic->category, $post->topic]) }}#post-{{ $post->id }}"
                    class="text-neutral-300 font-bold">{{ Str::limit($post->topic->title, 35) }}</a>
                <div>
                    <a href="{{ route('profile.show', $post->user) }}" class="font-bold text-sm" style="color: {{ $post->user->getUsernameColor() }};">{{ $post->user->username }}</a>
                    <span class="font-bold text-neutral-500 text-sm">- {{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        @if (!$loop->last)
            <!-- Do not add the line after the last post -->
            <hr class="border-neutral-800 my-1"> <!-- Add the horizontal line with a custom class -->
        @endif
    @endforeach
</div>
