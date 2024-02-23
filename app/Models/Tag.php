<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tag';
    protected $fillable = ['user_id','tag'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
class User extends Model
{
    /**
     * Get the profile associated with the user.
     */
    public function tag()
    {
        return $this->hasOne(Tag::class);
    }
}
