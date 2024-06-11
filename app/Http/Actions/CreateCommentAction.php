<?php

namespace App\Http\Actions;

use App\Models\Comment;

class CreateCommentAction
{
    /**
     * Executes adding a new comment to a post.
     *
     * @param array $data The array of comment data.
     * @return Comment The created comment object.
     */
    public static function execute($data): Comment
    {
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $data['postId'];
        $comment->body = $data['body'];
        $comment->save();

        return $comment;
    }
}
