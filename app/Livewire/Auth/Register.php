<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed', // confirmed untuk password_confirmation
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'member',
        ]);

        // Jangan login otomatis, tapi redirect ke login
        return redirect()->route('login')->with('loginMessage', 'Registrasi berhasil! Silakan login.');
    }

    #[Layout('layouts.app', ['hideNavbar' => true, 'hideSidebar' => true])]
    public function render()
    {
        return view('livewire.auth.register');
    }
}
