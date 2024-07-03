<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class UserController extends Component
{

    public $user = '';

    public $name = "Fuck thingthing";
    public $email = "ojan@fucking.thing";
    public $phone = "089623847260";
    public $role = '1';

    public $roles = [
        'Admin',
        'Pengguna',
        'Peninjau'
    ];

    public function render()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function store()
    {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        // $user->phone = $this->phone;
        $user->role = $this->role;
        $user->password = Hash::make('diskom123');
        $user->save();
        $this->dispatch('close-user-modal');
    }
}
