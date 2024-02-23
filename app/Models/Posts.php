<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class Posts extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $fillable = ['name','content','file'];

    public function comments() {
       return $this->hasMany(Comment::class, 'post_id','id');
    }
   
}


