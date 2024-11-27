<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable =[
        'comment_by',
        'comment_content',
        'comment_on'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'comment_by');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'comment_on');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'liked_comment');
    }
}
