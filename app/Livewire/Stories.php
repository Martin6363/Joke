<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stories extends Component
{
    public $followers;

    public function mount ()
    {
        $user = Auth::user();

        $this->followers = $user->follows()->get();
    }

    public function render()
    {   
        return view('livewire.stories', [
            'followers' => $this->followers // Use $this->followers to access the property
        ]);
    }
}
