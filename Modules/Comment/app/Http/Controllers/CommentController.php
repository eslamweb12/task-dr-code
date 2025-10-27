<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Services\CommentService;
use Modules\Comment\Http\Requests\StoreCommentRequest;
use Modules\Comment\Transformers\Comment as CommentResource;
use App\Traits\ApiResponseTrait;

class CommentController extends Controller
{
    use ApiResponseTrait;

    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $this->commentService->createComment($request->validated());

      
        return $this->successResponse(
            new CommentResource($comment),
            'Comment created successfully',
            201
        );
    }
}
