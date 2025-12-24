<?php

namespace App\Livewire\Pages\Post;

use Livewire\Component;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function delete($id)
    {
        $post = Post::findOrFail($id);

        // pastikan hanya owner yang boleh hapus
        abort_if($post->user_id !== Auth::id(), 403);

        $post->delete();

        session()->flash('success', 'Post berhasil dihapus');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.post.index', [
            'posts' => Post::with(['user','community'])
                ->latest()
                ->paginate(10)
        ]);
    }
}