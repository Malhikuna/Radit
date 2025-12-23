<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Livewire\Attributes\Layout;

class Create extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required|min:3|unique:communities,name',
        'description' => 'nullable|min:5',
    ];

    public function save()
    {
        $this->validate();

        Community::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Community berhasil dibuat');

        return redirect()->route('communities.index');
        // return redirect()->route('posts.create');
        // return redirect()->route('home');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.community.create', [
            'title' => 'Create Community'
        ]);
    }
}