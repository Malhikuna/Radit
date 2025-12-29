<?php

namespace App\Livewire\Comments;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Vote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentSection extends Component
{
    use AuthorizesRequests;

    public $post;

    /* =========================
     | CREATE / REPLY
     ========================= */
    public $content = '';
    public $parentId = null;
    public $replyToUser = null; // 🔥 TAMBAHAN

    /* =========================
     | EDIT
     ========================= */
    public $editId = null;
    public $editContent = '';

    /* =========================
     | TOGGLE REPLIES
     ========================= */
    public array $openReplies = [];

    protected $rules = [
        'content' => 'required|min:1|max:1000',
    ];

    /* =========================
     | CREATE COMMENT / REPLY
     ========================= */
    public function store()
    {
        $this->validate();

        Comment::create([
            'user_id'   => auth()->id(),
            'post_id'   => $this->post->id,
            'parent_id' => $this->parentId,
            'content'   => $this->content,
        ]);

        // 🔥 auto buka replies setelah balas
        if ($this->parentId) {
            $this->openReplies[$this->parentId] = true;
        }

        $this->reset([
            'content',
            'parentId',
            'replyToUser',
        ]);
    }

    /* =========================
     | SET REPLY TARGET
     ========================= */
        public function reply($commentId)
        {
            $comment = Comment::with('user')->findOrFail($commentId);

            $this->parentId = $commentId;
            $this->replyToUser = $comment->user->name;

            // ✅ textarea tetap kosong
            $this->content = '';

            // biar edit & reply nggak bentrok
            $this->reset(['editId', 'editContent']);
        }



    public function cancelReply()
    {
        $this->reset([
            'parentId',
            'replyToUser',
            'content',
        ]);
    }

    /* =========================
     | TOGGLE SHOW / HIDE REPLIES
     ========================= */
    public function toggleReplies($commentId)
    {
        $this->openReplies[$commentId] =
            !($this->openReplies[$commentId] ?? false);
    }

    /* =========================
     | EDIT COMMENT
     ========================= */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('update', $comment);

        $this->editId = $id;
        $this->editContent = $comment->content;

        // matikan reply mode
        $this->reset(['parentId', 'replyToUser']);
    }

    public function update()
    {
        $comment = Comment::findOrFail($this->editId);
        $this->authorize('update', $comment);

        $comment->update([
            'content' => $this->editContent
        ]);

        $this->reset(['editId', 'editContent']);
    }

    public function cancelEdit()
    {
        $this->reset(['editId', 'editContent']);
    }

    /* =========================
     | DELETE COMMENT (SOFT)
     ========================= */
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);

        $comment->delete();
    }

    /* =========================
     | VOTE COMMENT
     ========================= */
    public function voteComment($commentId, $value)
    {
        if (!auth()->check()) return;

        $comment = Comment::findOrFail($commentId);

        if ($comment->deleted_at) return;

        Vote::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'comment_id' => $commentId,
                'post_id'    => null,
            ],
            [
                'value' => $value,
            ]
        );
    }

    /* =========================
     | RENDER
     ========================= */
    public function render()
    {
        return view('livewire.comments.index', [
            'comments' => Comment::with([
                    'user',
                    'votes',
                    'replies.user',
                    'replies.votes',
                    'replies.replies.user',
                    'replies.replies.votes',
                ])
                ->where('post_id', $this->post->id)
                ->whereNull('parent_id')
                ->latest()
                ->get()
        ]);
    }
}
