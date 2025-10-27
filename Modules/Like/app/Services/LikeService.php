<?php

namespace Modules\Like\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Like\Models\Like;
use Modules\Blog\Models\Blog;

class LikeService
{
    public function toggleLike(array $data)
    {
        $user = Auth::user();

        $blog = Blog::findOrFail($data['blog_id']);

        // Prevent owner from liking their own blog
        if ($blog->user_id === $user->id) {
            return ['message' => 'You cannot like your own blog', 'like' => null];
        }

        $like = Like::where('blog_id', $data['blog_id'])
                    ->where('user_id', $user->id)
                    ->first();

        if ($like) {
            $like->delete();
            return ['message' => 'Blog unliked successfully', 'like' => null];
        } else {
            $like = new Like();
            $like->blog_id = $data['blog_id'];
            $like->user_id = $user->id;
            $like->save();

            return ['message' => 'Blog liked successfully', 'like' => $like];
        }
    }
}
