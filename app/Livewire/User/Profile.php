<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Vote;
use Livewire\Attributes\Layout;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $posts;
    public $comments;
    public $photo;
    public int $karma = 0;

    public function mount()
    {
        $this->user = Auth::user();
        abort_if(! $this->user, 403);

        $this->loadData();
    }

    protected function loadData()
    {
        /**
         * POSTS (WAJIB sesuai post-card)
         */
        $this->posts = Post::with([
            'user',
            'community',
            'images',
            'votes',
        ])
            ->withCount('comments')
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        /**
         * COMMENTS
         */
        $this->comments = Comment::with([
            'post',
            'post.community',
        ])
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        /**
         * KARMA (Reddit Style)
         */
        $this->karma =
            Vote::whereIn('post_id', $this->posts->pluck('id'))->sum('value') +
            Vote::whereIn('comment_id', $this->comments->pluck('id'))->sum('value');
    }

    // Methode untuk mengupdate foto
    public function updatedPhoto()
    {
        $this->updateProfilePicture();
    }

    public function updateProfilePicture()
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:5048',
        ]);

        $folder = public_path('profile-photos');

        // buat folder kalau belum ada
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // hapus foto lama kalau ada
        if ($this->user->avatar && file_exists(public_path($this->user->avatar))) {
            unlink(public_path($this->user->avatar));
        }

        // simpan foto baru
        $filename = time() . '_' . $this->photo->getClientOriginalName();
        $this->photo->move($folder, $filename);

        // update database
        $this->user->update([
            'avatar' => 'profile-photos/' . $filename
        ]);

        $this->reset('photo');
        $this->user = $this->user->fresh();
        session()->flash('success', 'Foto profil berhasil diperbarui!');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.profile', [
            'title' => 'My Profile',
        ]);
    }
}
