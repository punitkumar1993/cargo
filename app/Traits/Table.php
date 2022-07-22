<?php 

namespace App\Traits;

use App\Models\Post;

trait Table
{
    public function Post()
    {
        return Post::where('post_type', 'post');
    }
}