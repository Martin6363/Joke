<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PostLikeController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikePost extends Component
{
    public Post $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function toggleLike()
    {
        if (auth()->guest()) {
            return $this->redirect(round('login'), true);
        }
        
        $user = auth()->user();

        if ($user->hasLiked($this->post)) {
            $user->likes()->detach($this->post);
            return;
        }

        $user->likes()->attach($this->post);
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
