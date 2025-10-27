<?php

namespace Modules\Like\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Like\Database\Factories\LikeFactory;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    

    // protected static function newFactory(): LikeFactory
    // {
    //     // return LikeFactory::new();
    // }
     use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_id',
        
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
