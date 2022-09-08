<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signout extends Component
{
    public $class;

    public function mount($class)
    {
        $this->class = $class;
    }

    public function signOut()
    {
        Auth::logout();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.signout');
    }
}

