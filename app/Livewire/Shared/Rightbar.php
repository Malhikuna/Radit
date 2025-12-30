<?php
namespace App\Livewire\Shared;

use Livewire\Component;
use App\Models\Community;

class Rightbar extends Component
{
    public $communityId;
    public $community;

    public function mount($communityId = null)
    {
        // Jika tidak diberikan, coba ambil dari route
        if (!$communityId && request()->route('community')) {
            $communityId = request()->route('community')['id'] ?? null;
        }

        $this->communityId = $communityId;

        if ($communityId) {
            $this->community = Community::withCount('members')->find($communityId);
        }
    }

    public function render()
    {
        return view('livewire.shared.rightbar');
    }
}
