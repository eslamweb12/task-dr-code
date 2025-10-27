<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Blog extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'article'    => $this->article,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
           

            // Optional — include related user info
            'user' => [
                'id'    => $this->user->id ?? null,
                'name'  => $this->user->name ?? null,
                'email' => $this->user->email ?? null,
            ],
            'comments_count' => $this->comments_count,
            'likes_count' => $this->likes_count,
        ];
    }
}
