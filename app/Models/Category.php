<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    # Categories has many posts
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
}
