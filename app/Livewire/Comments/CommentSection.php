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

    /** create / reply */
    public $content = '';
    public $parentId = null;

    /** edit */
    public $editId = null;
    public $editContent = '';

    protected $rules = [
        'content' => 'required|min:3|max:1000',
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

        $this->reset(['content', 'parentId']);
    }

    /* =========================
     | SET REPLY TARGET
     ========================= */
    public function reply($id)
    {
        $this->parentId = $id;
        $this->content = '';
    }

    public function cancelReply()
    {
        $this->reset(['parentId', 'content']);
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
     | value: 1 / -1
     ========================= */
    public function voteComment($commentId, $value)
    {
        if (!auth()->check()) return;

        $comment = Comment::findOrFail($commentId);

        // jangan vote komentar yang dihapus
        if ($comment->deleted_at) return;

        Vote::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'comment_id' => $commentId,
                'post_id'    => null,
            ],
            [
                'value'      => $value,
                'created_at' => now(),
            ]
        );
    }

    /* =========================
     | RENDER
     ========================= */
    public function render()
    {
        return view('livewire.comments.comment-section', [
            'comments' => Comment::with([
                    'user',
                    'replies.user',
                    'replies.replies', // recursive eager load
                    'votes'
                ])
                ->where('post_id', $this->post->id)
                ->whereNull('parent_id')
                ->latest()
                ->get()
        ]);
    }
}
