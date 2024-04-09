<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LikeButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $post_id;
    
    public function __construct($post_id)
    {
        $this->post_id = $post_id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.like-button');
    }
}
