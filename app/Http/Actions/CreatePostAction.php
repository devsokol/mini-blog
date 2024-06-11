<?php

namespace App\Http\Actions;

use App\Models\Post;

class CreatePostAction
{
    /**
    * Executes adding a new post.
    *
    * @param array $data The array of post data.
    * @return Post The created post object.
    */
    public static function execute($data): Post
    {
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();

        return $post;
    }
}
