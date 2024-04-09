<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;


class PostComments extends Component
{
    public Post $post;

    #[Rule('required|min:1|max:1000')]
    public $comment;


    public function postComment() {
        $this->validateOnly('comment');
        $this->post->comments()->create([
            'message' => $this->comment,
            'user_id' => Auth::user()->id
        ]);

        $this->reset('comment');
    }

    #[Computed()]
    public function comments() {
        return Comment::with('user')->where('post_id', $this->post->id)->latest()->get();
    }    

    public function render()
    {
        $comments = $this->comments();
        return view('livewire.post-comments', compact('comments'));
    }
}
