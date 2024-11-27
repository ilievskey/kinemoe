<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    use HasFactory;

    protected $table = 'system_settings';

    protected $fillable = [
        'site_name',
        'image_path',
        'site_contact',
        'site_tos',
    ];
}
