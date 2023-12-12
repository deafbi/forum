<div>
    <table class="w-full">
        <tbody>
            @foreach ($latestPosts as $post)
                <tr class="flex items-center bg-[#212121] mb-3 rounded-md">
                    <td class="flex-none items-center justify-center px-5 py-3">
                        <img class="object-cover w-10 h-10 rounded-md" src="{{ $post->user->avatar }} " alt="" />
                    </td>
                    <td class="flex-grow text-gray-300">
                        <a class="font-bold text-lg"
                            href="{{ route('topics.show', [$post->topic->category, $post->topic]) }}#post-{{ $post->id }}">{{ Str::limit($post->content, 125) }}</a>
                        <div class="grid grid-cols-2 gap-2 font-bold w-[50%]">
                            <div class="flex space-x-1 text-sm">
                                <span class="text-neutral-500">in topic:</span><a
                                    href="{{ route('topics.show', [$post->topic->category, $post->topic]) }}"
                                    class="font-bold">
                                    {{ $post->topic->title }}</a>
                            </div>
                        </div>
                    </td>

                    <td class="items-center shadow-md">
                        <div
                            class="p-2 px-4 text-sm text-center bg-[#191919] bg-opacity-50 rounded-md text-gray-400 font-bold">
                            <div>
                                <p>{{ $post->topic->post_count }} replies</p>
                            </div>
                            <div>
                                <p>{{ $post->topic->view_count }} views</p>
                            </div>
                        </div>
                    </td>
                    <td class="flex px-5 items-center">

                        <div
                            class="p-2 px-4 text-sm text-center bg-[#191919] bg-opacity-50 py-2 rounded-md text-gray-400 font-bold">
                            <div>
                                <span class="text-neutral-500">by <a
                                        href="{{ route('profile.show', $post->topic->user->username) }}"
                                        class="font-bold {{ $post->topic->user->getUsernameColor() }}">{{ $post->topic->user->username }}</a></span>
                            </div>
                            <div>
                                {{ $post->topic->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $latestPosts->links() }}
</div>
