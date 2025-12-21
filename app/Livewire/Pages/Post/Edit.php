<?php

namespace App\Livewire\Pages\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    use WithFileUploads;

    public Post $post;

    public $title;
    public $content;
    public $url;
    public $type;
    public $community_id;
    public $communitySearch;
    public $image;
    public $communities = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'url' => 'nullable|url|max:500',
            'type' => 'required|in:text,image,link,video,poll',
            'community_id' => 'required|exists:communities,id',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function mount(Post $post)
    {
        // Hanya pemilik post yang bisa edit
        abort_if(Auth::id() !== $post->user_id, 403);

        $this->post = $post;

        // Isi data awal
        $this->title = $post->title;
        $this->content = $post->content;
        $this->url = $post->url;
        $this->type = $post->type;
        $this->community_id = $post->community_id;
    }

    public function updatedCommunitySearch()
    {
        if (strlen($this->communitySearch) > 1) {
            $this->communities = Community::where('name', 'like', "%{$this->communitySearch}%")
                ->orderBy('name')
                ->limit(5)
                ->get();
        } else {
            $this->communities = [];
        }
    }

    public function selectCommunity($id)
    {
        $this->community_id = $id;
        $this->communitySearch = '';
        $this->communities = [];
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function update()
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
            'url' => $this->url,
            'type' => $this->type,
            'community_id' => $this->community_id,
        ]);

        // Upload image jika ada
        if ($this->image) {
            $path = $this->image->store('posts', 'public');
            $this->post->images()->create(['file_path' => $path]);
        }

        return redirect()->route('posts.show', $this->post)
                         ->with('success', 'Post berhasil diperbarui');
    }

    public function cancel()
    {
        return redirect()->route('posts.show', $this->post);
    }

    public function render()
    {
        return view('livewire.pages.post.edit')
            ->layout('components.layout', [
                'title' => 'Edit Post',
            ]);
    }
}
