<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Chat extends Component
{
    public $messageText;

    public function render()
    {
        $messages = \App\Models\Message::with('user')->latest()->take(10)->get()->sortBy('id');

        return view('livewire.chat', compact('messages'));
    }

    public function sendMessage()
    {
        \App\Models\Message::create([
            'user_id' => auth()->user()->id,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }

}
