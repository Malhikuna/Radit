<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;

    public $profile_image;
    public $banner_image;

    protected $rules = [
        'name' => 'required|min:3|unique:communities,name|alpha_dash',
        'description' => 'nullable|min:5',

        'profile_image' => 'nullable|image|max:1024', 
        'banner_image' => 'nullable|image|max:2048', 
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function confirmSave()
    {
        $this->validate(); 

        $this->dispatch('open-confirm', 
            action: 'execute-create-community',
            title: 'Create Community?',
            description: "Are you sure you want to create r/" . $this->name . "?",
            params: [] 
        );
    }

    #[On('execute-create-community')]
    public function save()
    {
        $validated = $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'user_id' => Auth::id(),
            ];

            if ($this->profile_image) {
                $profilePath = $this->profile_image->store('communities/profiles', 'public');
                $data['profile_image'] = $profilePath;
            }

            if ($this->banner_image) {
                $bannerPath = $this->banner_image->store('communities/banners', 'public');
                $data['banner_image'] = $bannerPath;
            }

            $community = Community::create($data);

            $this->reset();

            $this->dispatch('flash', 
                type: 'success', 
                message: 'Community created successfully! Welcome to r/' . $community->name,
                redirect: route('communities.show', $community->id) 
            );
        
        } catch (\Exception $e) {
            $this->dispatch('flash', 
                type: 'error', 
                message: 'Failed to create community: ' . $e->getMessage()
            );
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.community.create', [
            'title' => 'Create Community',
        ]);
    }
}