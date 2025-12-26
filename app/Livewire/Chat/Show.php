<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Show extends Component
{
    public Conversation $conversation;
    public $messages;
    public string $body = '';

    // Dijalankan saat halaman chat dibuka
    public function mount(Conversation $conversation)
    {
        $this->conversation = $conversation;

        // Ambil semua pesan dari conversation
        $this->messages = $conversation->messages()->with('sender')->get();

        // Tandai pesan dari lawan sebagai sudah dibaca
        Message::where('conversation_id', $conversation->id)
            ->where('user_id', '!=', Auth::id())
            ->update(['is_read' => true]);
    }

    // Kirim pesan
    public function sendMessage()
    {
        $this->validate([
            'body' => 'required|string'
        ]);

        Message::create([
            'conversation_id' => $this->conversation->id,
            'user_id' => Auth::id(),
            'body' => $this->body,
        ]);

        // Refresh pesan
        $this->messages = $this->conversation->messages()->with('sender')->get();

        // Reset input
        $this->body = '';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.chat.show', [
            'title' => 'Show Chat'
        ]);
    }
}
