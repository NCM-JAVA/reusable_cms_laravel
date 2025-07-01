<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class Title extends Model
{
    use HasFactory;
	use ApprovalTraits;
	
    protected $fillable =[
        'title',
        'language',
        'icons',
        'page_url',
        'titleType',
        'txtstatus',
        'admin_id'
    ];
}
