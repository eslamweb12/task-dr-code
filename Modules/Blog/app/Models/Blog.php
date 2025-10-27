<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
  protected $fillable = ['user_id', 'article'];

  public function user(){

    return $this->belongsTo(\App\Models\User::class, 'user_id');
    
  }
  public function comments()
  {
    return $this->hasMany(\Modules\Comment\Models\Comment::class);
  }

  public function likes()
  {
    return $this->hasMany(\Modules\Like\Models\Like::class);
  }
}
