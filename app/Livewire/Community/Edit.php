<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Livewire\Attributes\Layout;

class Edit extends Component
{
    public Community $community;
    public $name;
    public $description;

    public function mount(Community $community)
    {
        $this->community = $community;
        $this->name = $community->name;
        $this->description = $community->description;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|unique:communities,name,' . $this->community->id,
            'description' => 'nullable|min:5',
        ]);

        $this->community->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        return redirect()->route('communities.index');
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.community.edit', [
            'title' => 'Edit Community'
        ]);
    }
}