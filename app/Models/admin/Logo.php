<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class Logo extends Model
{
    use HasFactory;
	use ApprovalTraits;
	
    protected $fillable =[
        'title',
		'logo_url',
        'language',
        'txtuplode',
        'txtstatus',
        'admin_id',
        'txttype'
    ];
}
