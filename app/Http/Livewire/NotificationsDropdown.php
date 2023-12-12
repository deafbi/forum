<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class NotificationsDropdown extends Component
{
    public function render()
    {
        $notifications = Notification::with(['post', 'post.topic'])
            ->where('user_id', auth()->id())
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.notifications-dropdown', compact('notifications'));
    }

    public function markAsRead($notificationId, $url)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->update(['read' => true]);

        return redirect($url);
    }
}
