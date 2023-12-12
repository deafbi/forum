<div>
    {{ $replies->links() }}
    @forelse($replies as $reply)
        <div class="flex" id="post-{{ $reply->id }}">
            <div class="w-full">
                <table id="#" class="table w-full mb-4 align-top border-gray-200 shadow-md text-neutral-200"
                    x-data="{
                        replyTo: '',
                        setReplyTo(username) {
                            this.replyTo = username;
                            this.$refs.replyInput.focus();
                        }
                    }" x-init="replyTo = ''">
                    <tbody>
                        <tr class="flex">
                            <!-- User Profile -->
                            <td class="table-cell text-center border-t border-l w-44 bg-zinc-800/10 border-neutral-800">
                                <!-- username -->

                                <div class="@if ($reply->user->avatar_bg) user-bg @endif"
                                    @if ($reply->user->avatar_bg) style="background-image: linear-gradient(to bottom, rgba(32, 32, 32, .5), rgba(25, 26, 30, 5)), url({{ $reply->user->avatar_bg }});" @endif>
                                    <div class="pt-5 user-info">
                                        <div class="flex-row">
                                            @if ($reply->user->is_banned)
                                                <a href="{{ route('profile.show', $reply->user) }}"
                                                    class="relative overflow-hidden text-xl font-black text-center"
                                                    style="color: {{ $reply->user->getUsernameColor() }};">
                                                    <strike>{{ $reply->user->username }}</strike>
                                                </a>
                                            @else
                                                <a href="{{ route('profile.show', $reply->user) }}"
                                                    class="relative overflow-hidden text-xl font-black text-center"
                                                    style="color: {{ $reply->user->getUsernameColor() }};">
                                                    <span
                                                        @if ($reply->user->isInGroup('Upgrade 1') || $reply->user->isInGroup('Upgrade 2')) style="background:url(https://i.imgur.com/lbPOgse.gif)" @endif>{{ $reply->user->username }}</span>
                                                </a>
                                            @endif
                                        </div>
                                        @if ($reply->user->is_banned)
                                            <p class="pt-4 text-xs font-bold text-red-500 uppercase">
                                                Banned member
                                            </p>
                                        @else
                                            <p class="text-xs font-bold">
                                                {{ $reply->user->title }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- avatar -->
                                    <p class="py-3">
                                        <a href="{{ route('profile.show', $reply->user) }}">
                                            <img src="{{ $reply->user->avatar }}"
                                                class="rounded-md inline-block text-6xl h-32 w-32 object-cover bg-center overflow-hidden align-bottom {{ $reply->user->hasBeenOnlinePast15Minutes() ? 'online-border' : '' }}"
                                                alt="username">
                                        </a>
                                    </p>
                                </div>
                                <!-- user roles -->
                                <div class="flex px-8 mb-4 space-x-4 justify-evenly">
                                    <div>
                                        <span
                                            class="font-bold text-xl {{ $reply->user->totalReputation() > 0 ? 'text-green-600' : ($reply->user->totalReputation() < 0 ? 'text-red-600' : 'text-gray-600') }}">{{ $reply->user->totalReputation() }}</span>
                                        <p class="text-xs font-bold text-neutral-500">Rep</p>
                                    </div>
                                    <div>
                                        <span
                                            class="font-bold text-xl {{ $reply->user->vouches->count() > 0 ? 'text-green-600' : ($reply->user->vouches->count() < 0 ? 'text-red-600' : 'text-gray-600') }}">{{ $reply->user->vouches->count() }}</span>
                                        <p class="text-xs font-bold text-neutral-500">Vouches</p>
                                    </div>
                                </div>
                                @if ($reply->user->show_displayed_group == 1 && $reply->user->displayedGroup)
                                    <div class="flex px-8 mb-4 space-x-4 justify-evenly">
                                        <div>
                                            <img src="{{ asset('storage/' . $reply->user->displayedGroup->group_avatar) }}"
                                                alt="">
                                        </div>
                                    </div>
                                @endif
                                <!-- user replies -->
                                <div class="px-4 mb-2 text-neutral-500">
                                    <div class="px-2 py-1 text-sm font-bold flex rounded bg-[#1D1E22] justify-between">
                                        <span class="font-bold">
                                            Posts:
                                        </span>
                                        <span>
                                            {{ $reply->user->post_count }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 mb-2 text-neutral-500">
                                    <div class="px-2 py-1 text-sm font-bold flex rounded bg-[#1D1E22] justify-between">
                                        <span class="">
                                            Threads:
                                        </span>
                                        <span>
                                            {{ $reply->user->topic_count }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 mb-2 text-neutral-500">
                                    <div class="px-2 py-1 text-sm font-bold flex rounded bg-[#1D1E22] justify-between">
                                        <span class="font-bold">
                                            Joined:
                                        </span>
                                        <span>
                                            {{ optional($reply->user->created_at)->format('M Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-4 mb-2 text-neutral-500">
                                    <div class="px-2 py-1 text-sm font-bold flex rounded bg-[#1D1E22] justify-between">
                                        <span class="font-bold">
                                            Credits:
                                        </span>
                                        <span>
                                            {{ $reply->user->credit }}
                                        </span>
                                    </div>
                                </div>
                                @if ($reply->user->awards->count() > 0)
                                    <div class="px-4 mb-2 text-neutral-500">
                                        <div
                                            class="grid grid-cols-5 px-4 py-2 text-sm font-bold rounded bg-[#1B1B1B] justify-center">
                                            @foreach ($reply->user->awards as $award)
                                                <img src="{{ asset('storage/' . Str::after($award->icon, 'public/')) }}"
                                                    class="w-6 h-6" alt="{{ $award->name }}">
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <!-- Reply content -->
                            <td class="flex-1 p-5 px-5 border bg-zinc-800/50 border-neutral-800">
                                <div class="flex items-center justify-between p-2 py-1 rounded-md bg-zinc-800/90 ">
                                    <div class="">
                                        <span class="flex items-center text-neutral-600">
                                            <svg class="inline-flex w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-1">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <p class="text-sm font-bold text-neutral-400">Posted
                                                {{ $reply->created_at->diffForHumans() }}
                                                @if ($reply->created_at != $reply->updated_at)
                                                    - Edited {{ $reply->updated_at->diffForHumans() }}
                                                @endif
                                            </p>
                                        </span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <a href="#"
                                            class="px-2 py-1 text-sm font-bold rounded-md">#{{ ($currentPage - 1) * $perPage + $loop->iteration }}</a>
                                    </div>
                                </div>
                                <div class="markdown">
                                    <p class="p-2 pt-4 markdown">
                                        {!! Str::markdown($reply->content) !!}
                                    </p>
                                    @if ($reply->user->signature)
                                        <hr class="h-px my-8 border-0 bg-neutral-700">
                                        <div class="markdown ">
                                            {!! Str::markdown($reply->user->signature) !!}
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr class="flex ">
                            <td class="w-full py-4 border-b border-l border-r bg-zinc-800/10 border-neutral-800">
                                <!-- Like and Reply buttons -->
                                <div class="flex items-center justify-between px-4">
                                    <div class="flex space-x-4">
                                        @if ($reply->isLikedByUser(auth()->user()))
                                            <form action="{{ route('posts.like.destroy', $reply) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="inline-flex items-center gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-rose-400/10 text-rose-400 ring-1 ring-inset ring-rose-400/20 hover:bg-rose-400/10 hover:text-rose-300 hover:ring-rose-300"
                                                    type="submit">

                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M22.0009 8.69106C22.0009 9.88106 21.8109 10.9811 21.4809 12.0011C19.9009 17.0011 15.0309 19.9911 12.6209 20.8111C12.2809 20.9311 11.7209 20.9311 11.3809 20.8111C10.7409 20.5911 9.93085 20.2211 9.06085 19.7011C8.50085 19.3711 8.41085 18.5911 8.87085 18.1311L20.1509 6.85106C20.6909 6.31106 21.6409 6.54106 21.8309 7.28106C21.9409 7.73106 22.0009 8.20106 22.0009 8.69106Z"
                                                                fill="#ffffff"></path>
                                                            <path
                                                                d="M22.5295 1.47141C22.2395 1.18141 21.7595 1.18141 21.4695 1.47141L19.1295 3.81141C18.3395 3.36141 17.4195 3.10141 16.4395 3.10141C14.6295 3.10141 13.0095 3.98141 11.9995 5.33141C10.9895 3.98141 9.36945 3.10141 7.55945 3.10141C4.48945 3.10141 1.99945 5.60141 1.99945 8.69141C1.99945 9.88141 2.18945 10.9814 2.51945 12.0014C3.16945 14.0714 4.38945 15.8014 5.76945 17.1714L1.46945 21.4714C1.17945 21.7614 1.17945 22.2414 1.46945 22.5314C1.61945 22.6814 1.80945 22.7514 1.99945 22.7514C2.18945 22.7514 2.37945 22.6814 2.52945 22.5314L22.5295 2.53141C22.8195 2.24141 22.8195 1.76141 22.5295 1.47141Z"
                                                                fill="#ffffff"></path>
                                                        </g>
                                                    </svg>


                                                    <span class="ml-2">Unlike</span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('posts.like.store', $reply) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="inline-flex items-center gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-cyan-400/10 text-cyan-400 ring-1 ring-inset ring-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-300 hover:ring-cyan-300"
                                                    type="submit">
                                                    <svg class="w-4 h-4 text-neutral-400" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M16.44 3.10156C14.63 3.10156 13.01 3.98156 12 5.33156C10.99 3.98156 9.37 3.10156 7.56 3.10156C4.49 3.10156 2 5.60156 2 8.69156C2 9.88156 2.19 10.9816 2.52 12.0016C4.1 17.0016 8.97 19.9916 11.38 20.8116C11.72 20.9316 12.28 20.9316 12.62 20.8116C15.03 19.9916 19.9 17.0016 21.48 12.0016C21.81 10.9816 22 9.88156 22 8.69156C22 5.60156 19.51 3.10156 16.44 3.10156Z"
                                                                fill="#ffffff"></path>
                                                        </g>
                                                    </svg>

                                                    <span class="ml-2">Like post</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">

                                        @can('update_posts')
                                            <a href="{{ route('posts.edit', ['topic' => $reply->topic->slug, 'post' => $reply->slug]) }}"
                                                class="inline-flex items-center gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-cyan-400/10 text-cyan-400 ring-1 ring-inset ring-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-300 hover:ring-cyan-300">
                                                <svg class="inline-flex w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path
                                                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                                    <path
                                                        d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                                </svg>

                                                Edit
                                            </a>
                                        @endcan
                                        @can('delete_post')
                                            <form
                                                action="{{ $reply->is_first_post ? route('topics.destroy', ['category' => $reply->topic->category->slug, 'topic' => $reply->topic->slug]) : route('posts.destroy', ['topic' => $reply->topic->slug, 'post' => $reply->slug]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this {{ $reply->is_first_post ? 'topic' : 'post' }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="inline-flex items-center gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-rose-400/10 text-rose-400 ring-1 ring-inset ring-rose-400/20 hover:bg-rose-400/10 hover:text-rose-300 hover:ring-rose-300">
                                                    <svg class="inline-flex w-4 h-4 mr-2"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd"
                                                            d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                        <button
                                            class="inline-flex items-center gap-0.5 justify-center overflow-hidden text-sm font-medium transition rounded-md bg-zinc-900 py-1 px-3 hover:bg-zinc-700 bg-cyan-400/10 text-cyan-400 ring-1 ring-inset ring-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-300 hover:ring-cyan-300"
                                            @click="replyTo = '{{ '@' . $reply->user->username }}'; $refs.replyInput.value = replyTo; $refs.replyInput.focus();">
                                            <svg class="inline-flex w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd"
                                                    d="M15.75 2.25H21a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0V4.81L8.03 17.03a.75.75 0 01-1.06-1.06L19.19 3.75h-3.44a.75.75 0 010-1.5zm-10.5 4.5a1.5 1.5 0 00-1.5 1.5v10.5a1.5 1.5 0 001.5 1.5h10.5a1.5 1.5 0 001.5-1.5V10.5a.75.75 0 011.5 0v8.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V8.25a3 3 0 013-3h8.25a.75.75 0 010 1.5H5.25z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            Reply
                                        </button>
                                    </div>
                                </div>
                                <div class="flex px-4">
                                    <ul>
                                        @forelse ($reply->usersWhoLiked as $user)
                                            <li class="pt-2 text-sm text-neutral-500">Users who liked this post:
                                                {{ $user->username }}</li>
                                        @empty
                                            <li class="pt-2 text-sm text-neutral-500">
                                                No one has liked this post yet.
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="flex justify-center">
            <p class="text-2xl text-center text-neutral-400">No replies found.</p>
        </div>
    @endforelse
    {{ $replies->links() }}
    @if (!$topic->locked)
        @auth
            <div class="flex">
                <div class="w-full">
                    <form action="{{ route('posts.store', [$category, 'topic' => $topic]) }}" method="post">
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        @csrf
                        <div class="w-full mb-4">
                            <textarea x-ref="replyInput" x-text="replyTo" name="content"
                                class="justify-center w-full px-3 py-2 overflow-hidden text-sm font-medium transition border-none rounded-md bg-zinc-800/40 text-zinc-400 ring-1 ring-inset ring-zinc-800 hover:bg-zinc-800 hover:text-zinc-300 focus:outline-none focus:ring-1 focus:ring-cyan-700 focus:ring-opacity-50"
                                id="content" rows="8" placeholder="Write your reply..."></textarea>
                        </div>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-[#191A1E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#191919] focus:bg-[#191919] active:bg-[#222222] focus:outline-none transition ease-in-out duration-150"
                            @click="setReplyTo('{{ '@' . $reply->user->username }}')">
                            <svg class="inline-flex w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                                    clip-rule="evenodd" />
                            </svg>
                            Make post
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    @else
        <div class="flex justify-center">
            <p class="text-2xl text-center text-neutral-400">This topic is locked.</p>
        </div>
    @endif
</div>
