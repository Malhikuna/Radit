<?php

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
    }
}
