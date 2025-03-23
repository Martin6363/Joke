<?php

namespace App\Livewire;

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
    public $comment;
    public $replyToCommentId;

    public $commentEditData;
    public $show = false;

    protected $rules = [
        'comment' => 'required|min:1|max:1000',
    ];

    public function postComment() {
        $this->validate();

        $this->post->comments()->create([
            'message' => $this->comment,
            'user_id' => Auth::user()->id
        ]);

        $this->reset(['comment', 'replyToCommentId']);
    }

    #[Computed()]
    public function comments() {
        return Comment::with('user')->where('post_id', $this->post->id)->latest()->get();
    }   

    public function edit($commentId) {
        $editData = Comment::findOrFail($commentId);
        $this->commentEditData = $editData;
        $this->comment = $editData->message;
    }


    public function replyTo($commentId)
    {
        $this->replyToCommentId = $commentId;
    }
 
    public function replyComment()
    {
        $this->validate([
            'comment' => 'required|min:1|max:1000',
        ]);
        
        $comment = Comment::findOrFail($this->replyToCommentId);
        $comment->replies()->create([
            'reply_text' => $this->comment,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset(['comment', 'replyToCommentId']);
    }

    public function toggleShow()
    {
        $this->show = !$this->show; 
    }

    public function render()
    {
        $comments = $this->post->comments()->with('user', 'replies')->latest()->get();
        return view('livewire.post-comments', compact('comments'));
    }
}
