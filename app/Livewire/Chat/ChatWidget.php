<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ChatWidget extends Component
{
    public $isOpen = false;
    public $view = 'welcome'; 
    public $activeConversationId = null;
    public $activeUserId = null;
    public $messageBody = '';
    public $searchQuery = '';

    public function getListeners()
    {
        $userId = Auth::id();
        return [
            "echo-private:chat.{$userId},.message.sent" => 'receiveMessage',
        ];
    }

    public function receiveMessage($event)
    {
        $this->dispatch('$refresh');

        if ($this->view === 'room' && $this->activeConversationId == $event['message']['conversation_id']) {
            $this->dispatch('scroll-bottom');
        }
    }

    public function sendMessage()
    {
        $this->validate([
            'messageBody' => 'required|string|max:1000',
            'activeConversationId' => 'required'
        ]);

        $message = Message::create([
            'conversation_id' => $this->activeConversationId,
            'user_id' => Auth::id(),
            'body' => $this->messageBody,
            'is_read' => false
        ]);

        $message->receiver_id = $this->activeUserId; 
        
        broadcast(new MessageSent($message))->toOthers();

        $this->messageBody = '';
        $this->dispatch('scroll-bottom');
    }

    public function openNewChat()
    {
        $this->view = 'new_chat';
        $this->searchQuery = '';
    }

    public function cancelNewChat()
    {
        $this->view = 'welcome';
    }

    public function openRoom($targetUserId)
    {
        $myId = Auth::id();
        $this->activeUserId = $targetUserId;

        $conversation = Conversation::where(function($q) use ($myId, $targetUserId) {
            $q->where('sender_id', $myId)->where('receiver_id', $targetUserId);
        })->orWhere(function($q) use ($myId, $targetUserId) {
            $q->where('sender_id', $targetUserId)->where('receiver_id', $myId);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => $myId,
                'receiver_id' => $targetUserId
            ]);
        }

        $this->activeConversationId = $conversation->id;
        $this->view = 'room';
        
        Message::where('conversation_id', $conversation->id)
            ->where('user_id', '!=', $myId)
            ->update(['is_read' => true]);

        $this->dispatch('scroll-bottom');
    }

    public function closeRoom()
    {
        $this->activeConversationId = null;
        $this->activeUserId = null;
        $this->view = 'welcome';
    }

    public function getConversationsProperty()
    {
        $userId = Auth::id();

        $conversations = Conversation::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['messages' => function($q) {
                $q->latest()->limit(1);
            }, 'sender', 'receiver'])
            ->get()
            ->sortByDesc(function($conversation) {
                return $conversation->messages->first()->created_at ?? $conversation->created_at;
            });

        $mapped = $conversations->map(function($chat) use ($userId) {
            $lastMessage = $chat->messages->first();
            $partner = ($chat->sender_id == $userId) ? $chat->receiver : $chat->sender;
            
            $isDeletedByMe = false;
            
            if ($lastMessage) {
                if ($lastMessage->user_id == $userId && $lastMessage->deleted_by_sender) {
                    $isDeletedByMe = true; 
                } elseif ($lastMessage->user_id != $userId && $lastMessage->deleted_by_receiver) {
                    $isDeletedByMe = true; 
                }
            } else {
                $isDeletedByMe = false; 
            }

            return (object) [
                'id' => $partner->id,
                'conversation_id' => $chat->id,
                'name' => $partner->name,
                'message' => $lastMessage ? $lastMessage->body : 'Start chatting', 
                'created_at' => $lastMessage ? $lastMessage->created_at : $chat->created_at,
                'read_at' => $lastMessage ? ($lastMessage->is_read ? 'read' : null) : 'read', 
                'sender_id' => $lastMessage ? $lastMessage->user_id : null,
                'is_deleted' => $isDeletedByMe, 
            ];
        });

        return $mapped->reject(function ($chat) {
            return $chat->is_deleted; 
        });
    }

    public function getActiveMessagesProperty()
    {
        if (!$this->activeConversationId) return collect();

        $myId = Auth::id();

        return Message::where('conversation_id', $this->activeConversationId)
        ->where(function($query) use ($myId) {
            $query->where(function($q) use ($myId) {
                $q->where('user_id', $myId)
                    ->where('deleted_by_sender', false);
            })
            ->orWhere(function($q) use ($myId) {
                $q->where('user_id', '!=', $myId)
                    ->where('deleted_by_receiver', false);
            });
        })
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function($msg) {
            $msg->sender_id = $msg->user_id; 
            $msg->message = $msg->body;
            $msg->read_at = $msg->is_read ? now() : null;
            return $msg;
        });
    }

    public function getActiveUserProperty()
    {
        return User::find($this->activeUserId);
    }

    public function getSearchResultsProperty()
    {
        if (strlen($this->searchQuery) < 2) return [];

        return User::where('id', '!=', Auth::id())
            ->where('name', 'like', '%' . $this->searchQuery . '%')
            ->take(5)
            ->get();
    }

    public function clearChat()
    {
        if ($this->activeConversationId) {
            $myId = Auth::id();

            Message::where('conversation_id', $this->activeConversationId)
                ->where('user_id', $myId)
                ->update(['deleted_by_sender' => true]);

            Message::where('conversation_id', $this->activeConversationId)
                ->where('user_id', '!=', $myId)
                ->update(['deleted_by_receiver' => true]);

            $this->dispatch('scroll-bottom');
        }
    }

    public function render()
    {
        return view('livewire.chat.chat-widget');
    }
}