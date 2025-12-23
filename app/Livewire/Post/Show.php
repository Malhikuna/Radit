<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{
    use AuthorizesRequests;

    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post->load([
            'user',
            'community',
            'images',
            'comments.user',
            'votes',
        ])->loadCount([
            'comments',
        ]);

        // Tambah view count
        $this->post->increment('views');
    }

    /**
     * DELETE POST
     */
    public function deletePost()
    {
        // Authorization (hanya pemilik post)
        abort_if(auth()->guest(), 403);
        abort_if(auth()->id() !== $this->post->user_id, 403);

        $this->post->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Post berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.pages.post.show')
            ->layout('components.layout', [
                'title' => $this->post->title,
            ]);
    }
}
