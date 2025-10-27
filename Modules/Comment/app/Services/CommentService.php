<?php
namespace Modules\Comment\Services;
use Illuminate\Support\Facades\Auth;
use Modules\Comment\Models\Comment;

class CommentService
{
    public function createComment(array $data)
    {
        $user = Auth::user();

        $comment = new Comment();
        $comment->blog_id = $data['blog_id'];
        $comment->user_id = $user->id;
        $comment->comment = $data['comment'];
        $comment->save();

        return $comment;
    }
}