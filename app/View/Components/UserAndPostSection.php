<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserAndPostSection extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $user;
    public $post;
    public $theme;
    public function __construct($user, $post, $theme)
    {
        $this->user = $user;
        $this->post = $post;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-and-post-section');
    }
}
