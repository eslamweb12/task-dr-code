<?php

namespace Modules\Like\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Like\Http\Requests\StoreLikeRequest;
use Modules\Like\Services\LikeService;
use Modules\Like\Transformers\Like as LikeResource;
use App\Traits\ApiResponseTrait;

class LikeController extends Controller
{
    use ApiResponseTrait;

    protected LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function store(StoreLikeRequest $request)
    {
     

        $response = $this->likeService->toggleLike($request->only('blog_id'));

        $data = $response['like'] ? new LikeResource($response['like']) : null;

        return $this->successResponse(
            $data,
            $response['message']
        );
    }
}
