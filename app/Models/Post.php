<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable =[
        'post_by',
        'post_title',
        'post_content'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'post_by');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'comment_on');
    }
    
    public function likes(){
        return $this->hasMany(Like::class, 'liked_post');
    }
}
