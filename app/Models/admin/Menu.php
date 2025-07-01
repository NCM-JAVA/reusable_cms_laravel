<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable =[
        'm_type',
        'm_flag_id',
        'menu_positions',
        'language_id',
        'm_name',
        'm_url',
        'm_title',
        'm_keyword',
        'm_description',
        'content',
        'doc_uplode',
        'linkstatus',
        'start_date',
        'end_date',
        'create_date',
        'update_date',
        'approve_status',  
        'admin_id',
        'page_postion',
        'current_version',
        'welcomedescription',
        'sitemap_positions'
    ];
}
