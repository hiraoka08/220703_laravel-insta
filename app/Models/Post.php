<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    # Get the owner of the post
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    # Post has many categories
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    #Get all comments of a post
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    #Get all likes of a post
    public function likes(){
        return $this->hasMany(Like::class);
    }

    #Returns true if the post is already liked
    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
