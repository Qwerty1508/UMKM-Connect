<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationCenter extends Component
{
    public function getNotificationsProperty()
    {
        return Auth::user() ? Auth::user()->notifications()->latest()->limit(10)->get() : [];
    }

    #[On('echo-private:App.Models.User.{userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated')]
    public function refreshNotifications()
    {
        // $this->dispatch('$refresh'); // Auto-refresh handled by computed property if re-rendered
    }
    
    public function getUserIdProperty()
    {
        return Auth::id();
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.notification-center');
    }
}
