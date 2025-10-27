<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\Services\BlogService;
use Modules\Blog\Transformers\Blog as BlogResource;
use App\Traits\ApiResponseTrait;
use Modules\Blog\Http\Requests\StoreBlogRequest;

class BlogController extends Controller
{
    use ApiResponseTrait;

    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Get all blogs
     */
    public function index()
    {
        $blogs = $this->blogService->index();
        return $this->successResponse(
            BlogResource::collection($blogs),
            'Blogs retrieved successfully'
        );
    }

    /**
     * Store a new blog post
     */
    public function store(StoreBlogRequest $request)
    {
       

        $blog = $this->blogService->create($request->all());
        return $this->successResponse(
             BlogResource::make($blog),
            'Blog created successfully',
            201
        );
    }

    /**
     * Show a specific blog
     */
    public function show($id)
    {
        $blog = $this->blogService->show($id);
        if (!$blog) {
            return $this->errorResponse('Blog not found', 404);
        }

        return $this->successResponse(
             BlogResource::make($blog),
            'Blog retrieved successfully'
        );
    }
}
