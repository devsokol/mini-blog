<?php

namespace App\Http\Controllers;

use App\Services\JsonPlaceholder\JsonPlaceholderService;
use App\Http\Actions\CreatePostAction;
use App\Http\Actions\CreateCommentAction;
use App\Models\Post;
use App\Models\Comment;

class DashboardController extends Controller
{
    /**
     * Syncs posts and their comments retrieved from the JsonPlaceholder service.
     *
     * @param JsonPlaceholderService $service The JsonPlaceholder service instance.
     * @return \Illuminate\Http\RedirectResponse Redirects back with success message if successful.
     */
    public function syncPosts(JsonPlaceholderService $service)
    {
        try {
            $postsData = $service->get('posts');

            Comment::query()->delete();
            Post::query()->delete();

            foreach ($postsData as $postData) {
                $post = CreatePostAction::execute($postData);
                $comments = $service->get('/comments?postId=' . $postData['id']);

                if (!empty($comments)) {
                    foreach ($comments as $comment) {
                        $comment['postId'] = $post->id;

                        CreateCommentAction::execute($comment);
                    }
                }
            }

            return redirect()->back()->with('success', 'Data saved successfully.');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}
