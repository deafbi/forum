<div x-data="{ show: false }">
    <button @click="show = !show">
        Bell Icon
        @if ($notifications->where('read', false)->count() > 0)
            <span class="text-red-500">•</span>
        @endif
    </button>

    <div x-show="show">
        @foreach ($notifications as $notification)
            <div>
                {{ $notification->content }}
                @if (!$notification->read)
                    <button wire:click="markAsRead({{ $notification->id }})">Mark as read</button>
                @endif
            </div>
        @endforeach
    </div>
</div>
