<div x-data="{
    open: false,
    toggle() {
        if (this.open) {
            return this.close()
        }

        this.$refs.button.focus()

        this.open = true
    },
    close(focusAfter) {
        if (!this.open) return

        this.open = false

        focusAfter && focusAfter.focus()
    }
}" x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="relative">
    <!-- Button -->
    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
        type="button" class="flex items-center gap-2 rounded-md shadow">
        <div class="flex items-center">
            <x-heroicon-s-bell class="w-6 h-6 text-neutral-400" />
            @if ($notifications->isNotEmpty())
                <span class="w-2 h-2 bg-red-600 rounded-full"></span>
            @endif
        </div>
    </button>

    <!-- Panel -->
    <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
        :id="$id('dropdown-button')" style="display: none;"
        class="absolute left-0 mt-2 w-40 rounded-md bg-[#202020] border border-[#252525] shadow-md">
        <div class="flex items-center hover:bg-[#282828] ">
            @forelse($notifications as $notification)
                <div class="flex items-center space-x-2 px-4 hover:bg-[#282828]">
                    <a href="#" wire:click.prevent="markAsRead({{ $notification->id }}, '{{ route('topics.show', ['category' => $notification->post->topic->category->slug, 'topic' => $notification->post->topic->slug]) }}')">Post {{ $notification->post_id }}</a>
                </div>
            @empty
                <div class="px-4 py-2 text-sm text-neutral-400">No new notifications</div>
            @endforelse
        </div>
    </div>
</div>
