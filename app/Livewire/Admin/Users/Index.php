<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name, $email, $password, $selectedUser, $search, $showForm;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'name.required' => 'Name is required.',
        'email.required' => 'Email is required.',
        'email.email' => 'Enter a valid email address.',
        'email.unique' => 'This email is already taken.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 6 characters.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addUser()
    {
        $this->selectedUser = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->showForm = true;
    }

    public function createUser()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        session()->flash('message', 'User created successfully!');
        $this->resetForm();
    }

    public function editUser(User $user)
    {
        $this->selectedUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->showForm = true;
    }

    public function cancelForm()
    {
        $this->showForm = false;
    }    

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->selectedUser->id,
        ]);

        $this->selectedUser->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'User updated successfully!');
        $this->resetForm();
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        session()->flash('message', 'User deleted successfully!');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->selectedUser = null;
        $this->showForm = false;
    }

    public function render()
    {
        $users = User::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        })->paginate(12);

        return view('livewire.admin.users.index', [
            'users' => $users,
        ]);
    }
}
