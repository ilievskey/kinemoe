<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = ['liked_by', 'liked_post', 'liked_comment'];

    public function user(){
        return $this->belongsTo(User::class, 'liked_by');
    }
    public function post(){
        return $this->belongsTo(Post::class, 'liked_post');
    }
    public function comment(){
        return $this->belongsTo(Comment::class, 'liked_comment');
    }
}