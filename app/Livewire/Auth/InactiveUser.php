<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class InactiveUser extends Component
{
    public function render()
    {
        return view('livewire.auth.inactive-user')->layout(layouts.guest);
    }
}
