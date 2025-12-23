<?php

namespace App\Livewire\Pages\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\Community;
use App\Models\PollOption;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

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
    public $video; // tambahan untuk video

    // ENUM posts.type
    public $type = 'text';

    // poll
    public $pollOptions = [];
    public $pollQuestion = '';

    public function mount()
    {
        $this->loadCommunities();
    }

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
            'video' => $this->type === 'video' ? 'required|mimetypes:video/mp4,video/quicktime|max:10240' : 'nullable',
            'pollQuestion' => $this->type === 'poll' ? 'required|string|max:255' : 'nullable',
            'pollOptions.*' => $this->type === 'poll' ? 'required|string|max:255' : 'nullable',
        ];
    }

    public function setType($type)
    {
        $this->type = $type;

        if ($type !== 'text') $this->content = '';
        if ($type !== 'link') $this->url = '';
        if ($type !== 'image') $this->image = null;
        if ($type !== 'video') $this->video = null;
        if ($type !== 'poll') {
            $this->pollQuestion = '';
            $this->pollOptions = [];
        }
    }

    public function addPollOption()
    {
        $this->pollOptions[] = '';
    }

    public function removePollOption($index)
    {
        unset($this->pollOptions[$index]);
        $this->pollOptions = array_values($this->pollOptions);
    }

    public function post()
    {
        $this->validate();

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

        // simpan image
        if ($this->type === 'image' && $this->image) {
            $imagePath = $this->image->store('posts', 'public');
            $post->images()->create([
                'file_path' => $imagePath,
                'type' => 'image',
            ]);
        }

        // simpan video
        if ($this->type === 'video' && $this->video) {
            $videoPath = $this->video->store('posts', 'public');
            $post->images()->create([ // bisa tetap pakai table images atau buat table videos
                'file_path' => $videoPath,
                'type' => 'video',
            ]);
        }

        // poll creation
        if ($this->type === 'poll' && $this->pollOptions) {
            foreach ($this->pollOptions as $optionText) {
                if ($optionText) {
                    PollOption::create([
                        'post_id' => $post->id,
                        'option_text' => $optionText,
                        'votes' => 0,
                    ]);
                }
            }
        }

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.pages.post.create')
            ->layout('components.layout', [
                'title' => 'Create Post'
            ]);
    }
}
