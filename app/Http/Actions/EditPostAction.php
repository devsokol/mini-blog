<?php

namespace App\Http\Actions;

use App\Models\Post;

class EditPostAction
{
    /**
    * Executes editing a post.
    *
    * @param array $data The array of post data.
    * @return Post The created post object.
    */
    public static function execute(Post $post, $data): Post
    {
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();

        return $post;
    }
}
