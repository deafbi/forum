<x-app-layout>
    <div class="mx-auto">
        @livewire('breadcrumb', ['category' => $category, 'topic' => $topic])

        @include('partials.flash-messages')

        <div class="flex items-center mb-4">
            <h1 class="text-2xl font-extrabold text-neutral-200">
                {{ $topic->title }}
            </h1>
        </div>
        <div x-data="{ replyTo: '' }" x-ref="replyContainer">
            @livewire('post-list', ['topicId' => $topic->id])
        </div>
    </div>
    @push('scripts')
        <script>
            Livewire.on('setReplyTo', username => {
                document.querySelector('[x-ref="replyContainer"]').__x.$data.replyTo = username;
            });
        </script>
    @endpush
</x-app-layout>
