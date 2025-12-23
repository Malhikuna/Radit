<?php

<<<<<<< HEAD:app/Livewire/Community/Index.php
namespace App\Livewire\Community;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.community.index');
=======
namespace App\Livewire\Pages\Community;

use Livewire\Component;
use App\Models\Community;

class Index extends Component
{
    public function delete($id)
    {
        Community::findOrFail($id)->delete();

        session()->flash('success', 'Community berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.pages.community.index', [
            'communities' => Community::latest()->get()
        ])->layout('components.layout', [
            'title' => 'Communities'
        ]);
>>>>>>> 235d953b77b221caa7e2489c340946dc09ab07f7:app/Livewire/Pages/Community/Index.php
    }
}
