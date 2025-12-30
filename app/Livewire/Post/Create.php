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
    public $content = ''; // hanya content
    public $url = '';
    public $image;
    public $video;

    public $type = 'text';

    // poll
    public $pollQuestion = '';
    public $pollOptions = ['', ''];

    /* =========================
     * MOUNT
     * ========================= */
    public function mount($community = null)
    {
        if ($community) {
            $communityModel = Community::find($community);
            if ($communityModel) {
                $this->community_id = $communityModel->id;
                $this->communitySearch = $communityModel->name;
            }
        }
    }

    /* =========================
     * COMMUNITY SEARCH
     * ========================= */
    public function updatedCommunitySearch()
    {
        if (strlen($this->communitySearch) < 1) {
            $this->communities = [];
            return;
        }

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

    /* =========================
     * REALTIME VALIDATION
     * ========================= */
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function updatedVideo()
    {
        $this->validateOnly('video');
    }

    /* =========================
     * RULES
     * ========================= */
    protected function rules()
    {
        $rules = [
            'community_id' => 'required|exists:communities,id',
            'title'        => 'required|string|min:3|max:255',
            'type'         => 'required|in:text,image,video,link,poll',
        ];

        if ($this->type === 'text') {
            $rules['content'] = 'required|string|min:5';
        }

        if ($this->type === 'link') {
            $rules['url'] = 'required|url|max:500';
        }

        if ($this->type === 'image') {
            $rules['image'] = ['required','image','mimes:jpg,jpeg,png,webp','max:2048'];
        }

        if ($this->type === 'video') {
            $rules['video'] = ['required','file','mimetypes:video/mp4,video/webm,video/ogg','max:20480'];
        }

        if ($this->type === 'poll') {
            $rules['pollQuestion']  = 'required|string|min:5|max:255';
            $rules['pollOptions']   = 'required|array|min:2|max:6';
            $rules['pollOptions.*'] = 'required|string|min:1|max:100';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'community_id.required' => 'Pilih community terlebih dahulu',
            'title.required'        => 'Title wajib diisi',
            'title.min'             => 'Title minimal 3 karakter',
            'title.max'             => 'Title maksimal 255 karakter',

            'content.required'      => 'Konten tidak boleh kosong',
            'url.required'          => 'Link wajib diisi',
            'url.url'               => 'Format URL tidak valid',

            'image.required'        => 'Gambar wajib diupload',
            'image.image'           => 'File harus berupa gambar',
            'image.max'             => 'Ukuran gambar maksimal 2 MB',

            'video.required'        => 'Video wajib diupload',
            'video.mimetypes'       => 'Format video tidak didukung',
            'video.max'             => 'Ukuran video maksimal 20 MB',

            'pollQuestion.required' => 'Pertanyaan poll wajib diisi',
            'pollOptions.min'       => 'Minimal 2 opsi poll',
            'pollOptions.max'       => 'Maksimal 6 opsi poll',
            'pollOptions.*.required'=> 'Opsi poll tidak boleh kosong',
        ];
    }

    /* =========================
     * SET TYPE
     * ========================= */
    public function setType($type)
    {
        $this->resetErrorBag();
        $this->type = $type;

        $this->content = '';
        $this->url     = '';
        $this->image   = null;
        $this->video   = null;

        if ($type === 'poll') {
            $this->pollQuestion = '';
            $this->pollOptions  = ['', ''];
        } else {
            $this->pollQuestion = '';
            $this->pollOptions  = [];
        }
    }

    /* =========================
     * POLL
     * ========================= */
    public function addPollOption()
    {
        if (count($this->pollOptions) < 6) {
            $this->pollOptions[] = '';
        }
    }

    public function removePollOption($index)
    {
        unset($this->pollOptions[$index]);
        $this->pollOptions = array_values($this->pollOptions);
    }

    /* =========================
     * SUBMIT
     * ========================= */
    public function post()
    {
        $validated = $this->validate();

        if ($this->type === 'poll') {
            $this->pollOptions = array_values(array_unique(array_filter($this->pollOptions)));
        }

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

        if ($this->type === 'image' && $this->image) {
            $path = $this->image->store('posts', 'public');
            $post->images()->create(['file_path'=>$path,'type'=>'image']);
        }

        if ($this->type === 'video' && $this->video) {
            $path = $this->video->store('posts', 'public');
            $post->images()->create(['file_path'=>$path,'type'=>'video']);
        }

        if ($this->type === 'poll') {
            foreach ($this->pollOptions as $option) {
                PollOption::create(['post_id'=>$post->id,'option_text'=>$option]);
            }
        }

        return redirect()->route('home');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.post.create', ['title'=>'Create Post']);
    }
}
