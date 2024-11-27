<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $table = 'content';

    protected $fillable = [
        'image_path',
        'title',
        'description',
        'url',
        'genre_id',
        'cast',
        'content_type',
        'release_date',
        'scheduled_for'
    ];

    protected $dates = ['release_date', 'scheduled_for'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'content_user');
    }
}
