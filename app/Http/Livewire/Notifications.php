<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class Notifications extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = auth()->user()->notifications;
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->read = true;
        $notification->save();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
