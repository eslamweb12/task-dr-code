<?php

namespace Modules\Blog\Services;

use Modules\Blog\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogService
{
    public function index()
    {
        return  Blog::with('user')->withCount(['comments', 'likes'])->get();
    }

    public function show($id)
    {
        return Blog::with('user')->withCount(['comments', 'likes'])->findOrFail($id);
    }

    public function create(array $data)
    {
        $user = Auth::user();

        $blog = new Blog();
        $blog->user_id = $user->id;
        $blog->article = $data['article'];
        $blog->title = $data['title'] ?? null;

        if (isset($data['image']) && $data['image']->isValid()) {
        $file = $data['image'];
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/blogs'), $filename);
        $blog->image = 'uploads/blogs/' . $filename;
    }
        $blog->save();

        return $blog;
    }
}
