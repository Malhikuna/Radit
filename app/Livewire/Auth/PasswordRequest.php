<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;

class PasswordRequest extends Component
{
    public $email = '';
    public $statusMessage = '';
    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    public function sendLink()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->statusMessage = 'Link reset password telah dikirim ke email Anda.';
            $this->errorMessage = '';
        } else {
            $this->errorMessage = 'Email tidak ditemukan di sistem.';
            $this->statusMessage = '';
        }
    }

    #[Layout('layouts.app', ['hideNavbar' => true, 'hideSidebar' => true])]
    public function render()
    {
        return view('livewire.auth.password-request');
    }
}
