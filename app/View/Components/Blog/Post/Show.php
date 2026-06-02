<?php

namespace App\View\Components\Blog\Post;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class Show extends Component
{
    /**
     * Create a new component instance.
     */
    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog.post.show');
    }
}
