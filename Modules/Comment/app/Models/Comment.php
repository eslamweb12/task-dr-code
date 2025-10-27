<?php

namespace Modules\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Comment\Database\Factories\CommentFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['blog_id', 'user_id', 'comment'];

    // protected static function newFactory(): CommentFactory
    // {
    //     // return CommentFactory::new();
    // }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
