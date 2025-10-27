<?php

namespace Modules\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'blog_id' => 'required|exists:blogs,id', 
            'comment' => 'required|string|max:500',   
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
