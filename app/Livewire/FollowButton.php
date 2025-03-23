<?php

namespace App\Livewire;

use App\Events\UserFollowed;
use App\Models\Follow; 
use App\Models\User;
use App\Notifications\UserFollowedNotification;
use Livewire\Component;

class FollowButton extends Component
{

    public User $user;
    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function toggleFollow () 
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            return redirect()->route('login');
        }

        if ($currentUser->hasFollowed($this->user)) {
            $currentUser->follows()->detach($this->user->id);
            $this->isLoading = true;
        } else {
            $currentUser->follows()->attach($this->user->id);
            // event(new UserFollowed($currentUser, $this->user));
            // $this->user->notify(new UserFollowedNotification($currentUser));
        }
    }


    public function render()
    {
        return view('livewire.follow-button');
    }
}
