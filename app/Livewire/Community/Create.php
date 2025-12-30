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
        // Validasi input
        $this->validate();

        // Simpan ke database
        $community = Community::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        // Flash message
        session()->flash('success', 'Community berhasil dibuat');

        // Redirect ke halaman community yang baru dibuat
        return redirect()->route('communities.show', $community->id);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.community.create', [
            'title' => 'Create Community',
        ]);
    }
}
