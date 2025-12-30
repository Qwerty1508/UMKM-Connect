<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class RealtimeChat extends Component
{
    use WithFileUploads;

    public $storeId = 1; // Default store for prototype
    public $message = '';
    public $attachment;
    public $messages = [];

    public function mount()
    {
        $this->messages = Message::where('store_id', $this->storeId)->with('user')->get();
    }

    #[On('echo-private:chat.{storeId},MessageSent')]
    public function refreshMessages($event)
    {
        $this->messages->push(new Message($event['message']));
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required',
        ]);

        $msg = Message::create([
            'store_id' => $this->storeId,
            'user_id' => Auth::id() ?? 1, // Fallback for prototype
            'content' => $this->message,
            'is_from_seller' => false,
        ]);

        broadcast(new MessageSent($msg))->toOthers();

        $this->messages->push($msg);
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.realtime-chat')->layout('layouts.app');
    }
}
