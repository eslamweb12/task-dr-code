<?php

namespace Modules\Comment\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
       return [
            'id'      => $this->id,
            'user_id'      => $this->user_id,
            'blog_id' => $this->blog_id,
            'comment'    => $this->comment,
            
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
