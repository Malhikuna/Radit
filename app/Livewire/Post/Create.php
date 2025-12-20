<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class Create extends Component
{
    use WithFileUploads;

    public $community_id = null;
    public $communitySearch = '';
    public $communities = [];

    public $title = '';
    public $content = '';
    public $url = '';
    public $image;

    // ENUM posts.type
    public $type = 'text';

    /**
     * Load data awal
     */
    public function mount()
    {
        $this->loadCommunities();
    }

    /**
     * Search community realtime
     */
    public function updatedCommunitySearch()
    {
        $this->loadCommunities();
    }

    private function loadCommunities()
    {
        $this->communities = Community::where('name', 'like', '%' . $this->communitySearch . '%')
            ->orderBy('name')
            ->limit(5)
            ->get();
    }

    public function selectCommunity($id)
    {
        $community = Community::findOrFail($id);

        $this->community_id = $id;
        $this->communitySearch = $community->name;

        // tutup dropdown
        $this->communities = [];
    }

    protected function rules()
    {
        return [
            'community_id' => 'required|exists:communities,id',
            'title' => 'required|string|max:255',
            'content' => $this->type === 'text' ? 'nullable|string' : 'nullable',
            'url' => $this->type === 'link' ? 'required|url|max:500' : 'nullable',
            'image' => $this->type === 'image' ? 'required|image|max:2048' : 'nullable',
        ];
    }

    public function setType($type)
    {
        $this->type = $type;

        if ($type !== 'text') {
            $this->content = '';
        }

        if ($type !== 'link') {
            $this->url = '';
        }

        if ($type !== 'image') {
            $this->image = null;
        }
    }

    

    public function post()
    {
        $this->validate();

        // buat post dulu
        $post = Post::create([
            'user_id' => Auth::id(),
            'community_id' => $this->community_id,
            'title' => $this->title,
            'content' => $this->type === 'text' ? $this->content : null,
            'url' => $this->type === 'link' ? $this->url : null,
            'type' => $this->type,
            'status' => 'published',
            'views' => 0,
        ]);

        // jika tipe image, simpan di tabel images
        if ($this->type === 'image' && $this->image) {
            $imagePath = $this->image->store('posts', 'public');

            $post->images()->create([
                'file_path' => $imagePath,
                'type' => 'image',
            ]);
        }

        return redirect()->route('home');
    }

    #[Layout('components.layout')]
    public function render()
    {
        return view('livewire.post.create', [
            'title' => 'Create Post'
        ]);
    }
}