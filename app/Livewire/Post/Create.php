<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use App\Models\Community;
use App\Models\PollOption;
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
    public $video;

    // ENUM posts.type
    public $type = 'text';

    // poll
    public $pollOptions = [];
    public $pollQuestion = '';

    /**
     * Mount Livewire component
     * @param int|null $community
     */
    public function mount($community = null)
    {
        $this->communities = [];

        if ($community) {
            $communityModel = Community::find($community);
            if ($communityModel) {
                $this->community_id = $communityModel->id;
                $this->communitySearch = $communityModel->name;
            }
        }
    }

    /**
     * LIVE SEARCH COMMUNITY
     */
    public function updatedCommunitySearch()
    {
        if (strlen($this->communitySearch) < 1) {
            $this->communities = [];
            return;
        }

        $this->loadCommunities();
    }

    public function loadCommunities()
    {
        $this->communities = Community::query()
            ->where('name', 'like', '%' . $this->communitySearch . '%')
            ->orderBy('name')
            ->limit(5)
            ->get();
    }

    public function selectCommunity($id)
    {
        $community = Community::findOrFail($id);

        $this->community_id = $community->id;
        $this->communitySearch = $community->name;
        $this->communities = [];
    }

    /**
     * Validation rules
     */
    protected function rules()
    {
        return [
            'community_id' => 'required|exists:communities,id',
            'title' => 'required|string|max:255',

            'content' => $this->type === 'text'
                ? 'nullable|string'
                : 'nullable',

            'url' => $this->type === 'link'
                ? 'required|url|max:500'
                : 'nullable',

            'image' => $this->type === 'image'
                ? 'required|image|max:2048'
                : 'nullable',

            'video' => $this->type === 'video'
                ? 'required|mimetypes:video/mp4,video/quicktime|max:10240'
                : 'nullable',

            'pollQuestion' => $this->type === 'poll'
                ? 'required|string|max:255'
                : 'nullable',

            'pollOptions.*' => $this->type === 'poll'
                ? 'required|string|max:255'
                : 'nullable',
        ];
    }

    /**
     * Set post type
     */
    public function setType($type)
    {
        $this->type = $type;

        if ($type !== 'text')  $this->content = '';
        if ($type !== 'link')  $this->url = '';
        if ($type !== 'image') $this->image = null;
        if ($type !== 'video') $this->video = null;

        if ($type !== 'poll') {
            $this->pollQuestion = '';
            $this->pollOptions = [];
        }
    }

    /**
     * Poll options
     */
    public function addPollOption()
    {
        $this->pollOptions[] = '';
    }

    public function removePollOption($index)
    {
        unset($this->pollOptions[$index]);
        $this->pollOptions = array_values($this->pollOptions);
    }

    /**
     * Submit post
     */
    public function post()
    {
        $this->validate();

        $post = Post::create([
            'user_id'      => Auth::id(),
            'community_id' => $this->community_id,
            'title'        => $this->title,
            'content'      => $this->type === 'text' ? $this->content : null,
            'url'          => $this->type === 'link' ? $this->url : null,
            'type'         => $this->type,
            'status'       => 'published',
            'views'        => 0,
        ]);

        // IMAGE
        if ($this->type === 'image' && $this->image) {
            $path = $this->image->store('posts', 'public');

            $post->images()->create([
                'file_path' => $path,
                'type'      => 'image',
            ]);
        }

        // VIDEO
        if ($this->type === 'video' && $this->video) {
            $path = $this->video->store('posts', 'public');

            $post->images()->create([
                'file_path' => $path,
                'type'      => 'video',
            ]);
        }

        // POLL
        if ($this->type === 'poll') {
            foreach ($this->pollOptions as $option) {
                if ($option) {
                    PollOption::create([
                        'post_id'    => $post->id,
                        'option_text'=> $option,
                    
                    ]);
                }
            }
        }

        return redirect()->route('home');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.post.create', [
            'title' => 'Create Post'
        ]);
    }
}