<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Transformers\User as UserResource;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    use ApiResponseTrait;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request);

        // ✅ Pass only the user model to the resource
        return $this->successResponse([
            'user' => new UserResource($data['user']),
            'token' => $data['token'],
        ], 'User registered successfully', 201);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request);

        if (!$result) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        return $this->successResponseWithToken(
            new UserResource($result['user']),
            'Login successful',
            200,
            $result['token']
        );
    }


}
