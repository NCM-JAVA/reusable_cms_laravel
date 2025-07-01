<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_login_id',
        'website_name',
        'website_short_name',
        'website_tags_name',
        'logo',
        'favicon',
        'department',
        'other1',
        'language',
        'other2'
   ];
}
