<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

class PasswordReset extends Component
{
    public $email;
    public $password;
    public $password_confirmation;
    public $token;
    public $statusMessage = '';
    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    /**
     * Mount method dijalankan saat halaman di-load
     * @param string $token Token dari URL
     */
    public function mount($token)
    {
        $this->token = $token;
        // Ambil email dari query string ?email=
        $this->email = request()->query('email', '');
    }

    /**
     * Reset password
     */
    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $this->statusMessage = 'Password berhasil direset. Silakan login.';
            $this->errorMessage = '';
            return redirect()->route('login');
        } else {
            $this->statusMessage = '';
            $this->errorMessage = 'Token atau email tidak valid / sudah kadaluarsa.';
        }
    }

    #[Layout('layouts.app', ['hideNavbar' => true, 'hideSidebar' => true])]
    public function render()
    {
        return view('livewire.auth.password-reset');
    }
}
