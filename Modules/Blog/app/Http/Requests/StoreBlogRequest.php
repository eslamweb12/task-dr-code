<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'title'   => 'required|string|max:255',              
            'article' => 'required|string|max:5000',           
            'image'   => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', 
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
