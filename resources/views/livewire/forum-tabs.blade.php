<div x-data="{ activeTab: localStorage.getItem('activeTab') || '{{ $tabs->first()->slug }}' }">

    <nav class="grid grid-flow-col mx-auto mb-4 space-x-4 text-center">
        @foreach ($tabs as $tab)
            <button wire:click="setActiveTab('{{ $tab->slug }}')"
                @click="activeTab = '{{ $tab->slug }}'; localStorage.setItem('activeTab', '{{ $tab->slug }}')"
                class="py-2 text-lg font-bold text-white rounded-md"
                :class="activeTab === '{{ $tab->slug }}' ? 'bg-cyan-700' : 'bg-zinc-800'">{{ ucfirst($tab->name) }}</button>
        @endforeach
    </nav>

    <main class="" x-data="{ minHeight: 'auto' }" x-on:update-container-height.window="minHeight = $event.detail + 'px'"
        x-bind:style="'min-height:' + minHeight">
        @foreach ($tabs as $tab)
            <section class="">
                <div class="space-y-4" x-show.transition.opacity="activeTab === '{{ $tab->slug }}'"
                    x-on:show="updateHeight" x-cloak>
                    @foreach ($tab->sections as $section)
                        <x-block :title="__('' . $section->name)" :description="__('Recent activity like posts, topics, reputation and vouch')">
                            <table class="w-full">
                                <tbody>
                                    @foreach ($section->categories as $category)
                                        <tr class="flex items-center">
                                            <td class="flex-grow py-3 text-gray-300">
                                                <a href="{{ route('topics.index', $category) }}"
                                                    class="text-xl font-bold">{{ $category->name }}</a>
                                                @if ($category->subcategories->count() > 0)
                                                    <div class="grid grid-cols-2 gap-2 mt-2">
                                                        @foreach ($category->subcategories as $subcategory)
                                                            <div class="flex items-center space-x-2">
                                                                <a class="font-bold break-words"
                                                                    href="{{ route('subcategory.topics.index', [$category, $subcategory]) }}"
                                                                    style="max-width: calc(70% - 0.5rem);">
                                                                    <span class="flex items-center gap-2">
                                                                        <span class="inline-flex items-center">
                                                                            <svg class="w-4 h-4 text-cyan-300"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                viewBox="0 0 24 24" fill="currentColor"
                                                                                class="w-6 h-6">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </span>
                                                                        {{ $subcategory->name }}
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="flex items-center py-3">
                                                @php
                                                    $latestPost = $category->topics
                                                        ->flatMap(function ($topic) {
                                                            return $topic->posts;
                                                        })
                                                        ->sortByDesc('created_at')
                                                        ->first();

                                                    $latestTopic = $latestPost ? $latestPost->topic : null;
                                                    $latestUser = $latestPost ? $latestPost->user : null;
                                                    $timeAgo = $latestPost ? $latestPost->created_at->diffForHumans() : null;
                                                @endphp

                                                @if ($latestTopic && $latestUser)
                                                    <div
                                                        class="flex items-center py-2 text-right rounded-md shadow-md bg-zinc-800/60">
                                                        <div class="flex-row ml-4">
                                                            @if ($latestTopic && $latestTopic->topic && $latestTopic->tags->count() > 0)
                                                                @foreach ($latestTopic->tags as $tag)
                                                                    <span
                                                                        class="text-[{{ $tag->color }}]
                                                            font-bold text-sm">{{ $tag->name }}</span>
                                                                @endforeach
                                                            @endif
                                                            <a href="{{ route('topics.show', [$category, $latestTopic]) }}"
                                                                class="font-bold text-neutral-300">{{ Str::limit($latestTopic->title, 35) }}</a>
                                                            <div>
                                                                <a href="{{ route('profile.show', $latestUser) }}"
                                                                    class="text-sm font-bold"
                                                                    style="color: {{ $latestUser->getUsernameColor() }};">{{ $latestUser->username }}</a>
                                                                <span class="text-sm font-bold text-neutral-500">-
                                                                    {{ $latestUser->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                        <img class="object-cover w-10 h-10 ml-4 mr-4 rounded-md"
                                                            src="{{ $latestUser->avatar }}" alt="" />
                                                    </div>
                                                @else
                                                    <div class="font-bold text-gray-400">
                                                        <p>No topics available</p>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </x-block>
                    @endforeach
                </div>
            </section>
        @endforeach
    </main>
</div>
