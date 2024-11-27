<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable =[
        'role_name',
        'can_post',
        'can_comment',
        'can_like',
        'can_crud_other_profiles',
        'can_crud_other_posts',
        'can_crud_other_comments',
        'can_access_admin_dash',
        'can_highlight_posts',
        'can_verify_others',
        'can_action_others',
        'can_upload_content',
        'can_modify_site',
    ];
}
