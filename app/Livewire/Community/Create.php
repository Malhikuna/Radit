<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|min:3|unique:communities,name|alpha_dash',
        'description' => 'nullable|min:5',
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
        // Validasi input
        $validated = $this->validate();

        try {

            // Simpan ke database
            $community = Community::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->reset();

            // Flash message
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