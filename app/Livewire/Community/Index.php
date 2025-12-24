<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Livewire\Attributes\Layout;

class Index extends Component
{
    public function delete($id)
    {
        Community::findOrFail($id)->delete();

        session()->flash('success', 'Community berhasil dihapus');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.community.index', [
            'communities' => Community::latest()->get()
        ]);
    }
}