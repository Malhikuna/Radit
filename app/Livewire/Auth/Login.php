<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\Layout;

class Login extends Component
{
    public $email;
    public $password;
    public $loginError = ''; // menampilkan error interaktif

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    /**
     * Login manual
     */
    public function login()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        if (!$user) {
            $this->loginError = 'Email tidak terdaftar';
            return;
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->loginError = 'Password salah';
            return;
        }

        // login berhasil
        session()->regenerate();
        return redirect()->intended('/');
    }

    /**
     * Ambil error dari session OAuth
     */
    public function mount()
    {
        if (session('loginError')) {
            $this->loginError = session('loginError');
        }
    }

    #[Layout('layouts.app', ['hideNavbar' => true, 'hideSidebar' => true])]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
