<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Posts;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'post_id',
        'user_id',
        'comment_body'
    ];

    public function post() {
        return $this->belongsTo(Posts::class,'post_id','id');
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
