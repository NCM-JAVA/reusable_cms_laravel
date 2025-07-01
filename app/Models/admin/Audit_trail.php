<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit_trail extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_login_id',
        'page_id',
        'page_name',
        'page_action',
        'page_action_date',
        'ip_address',
        'page_title',
        'approve_status',
        'usertype',
        'lang'
    ];
}
