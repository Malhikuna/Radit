<?php

namespace App\Livewire\Pages\Community;

use Livewire\Component;
use App\Models\Community;

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

        return redirect()->route('posts.create');
        // return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.pages.community.create')
            ->layout('components.layout', [
                'title' => 'Create Community'
            ]);
    }
}
