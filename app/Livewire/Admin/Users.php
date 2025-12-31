<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Users extends Component
{
    use WithPagination;

    public $userId, $name, $email, $password, $role;
    public $isEdit = false;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Validasi
    protected function rules()
    {
        return [
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email,' . $this->userId,
            'password' => $this->isEdit ? 'nullable|min:6' : 'required|min:6',
            'role'     => 'required|in:admin,member',
        ];
    }

    // Create User
    public function store()
    {
        $this->validate();

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
            'role'     => $this->role,
        ]);

        $this->resetForm();
        session()->flash('success', 'User berhasil ditambahkan');
    }

    // Edit User
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name   = $user->name;
        $this->email  = $user->email;
        $this->role   = $user->role;

        $this->isEdit = true;
    }

    // Update User
    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);

        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
        ];

        // Update password hanya jika diisi
        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        $user->update($data);

        $this->resetForm();
        session()->flash('success', 'User berhasil diupdate');
    }

    // Delete User
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'User berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'role', 'isEdit']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10)
        ])->layout('layouts.admin');
    }
}
