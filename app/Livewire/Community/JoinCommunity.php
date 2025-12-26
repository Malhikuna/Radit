<?php

namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;

class JoinCommunity extends Component
{
    public Community $community;
    public bool $joined = false;
    public int $membersCount = 0;

    public function mount(Community $community)
    {
        $this->community = $community;

        // Cek apakah user sudah join
        $this->joined = $community->members()
            ->where('user_id', Auth::id())
            ->exists();

        // Hitung jumlah member
        $this->membersCount = $community->members()->count();
    }

    public function toggleJoin()
    {
        $user = Auth::user();

        if ($this->joined) {
            $this->community->members()->detach($user->id);
            $this->joined = false;
        } else {
            $this->community->members()->attach($user->id);
            $this->joined = true;
        }

        // Update jumlah member
        $this->membersCount = $this->community->members()->count();
    }

    public function render()
    {
        return view('livewire.community.join-community');
    }
}
