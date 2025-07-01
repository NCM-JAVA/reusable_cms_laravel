<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable =[
        'visitors_ip',
        'visitors_count',
        'page_name',
        'browser',
        'device',
        'language'
    ];
}
