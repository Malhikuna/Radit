<?php
namespace App\Livewire\Community;

use Livewire\Component;
use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Show extends Component
{
    public Community $community;

    public function mount(Community $community): void
    {
        $this->community = $community->loadCount('members');
        $this->checkIfJoined();
    }

    public bool $joined = false;

    public function checkIfJoined()
    {
        $user = Auth::user();
        $this->joined = $user ? $this->community->members()->where('user_id', $user->id)->exists() : false;
    }

    public function toggleJoin()
    {
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'Silahkan login terlebih dahulu.');
            return;
        }

        if ($this->joined) {
            // unjoin
            $this->community->members()->detach($user->id);
            $this->joined = false;
            session()->flash('success', 'Berhasil keluar dari komunitas.');
        } else {
            // join
            $this->community->members()->attach($user->id);
            $this->joined = true;
            session()->flash('success', 'Berhasil join komunitas!');
        }

        // reload jumlah anggota
        $this->community->loadCount('members');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.community.show', [
            'community' => $this->community,
            'title' => 'r/' . $this->community->name
        ]);
    }
}
