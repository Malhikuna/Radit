<?php
namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Login extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            session()->regenerate();
            return redirect('/');
        }

        $this->addError('email', 'Email atau password salah');
    }

    #[Layout('layouts.app', ['hideNavbar' => true, 'hideSidebar' => true])]
    public function render()
    {
        return view('livewire.auth.login');
    }
}