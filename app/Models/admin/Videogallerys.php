<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class Videogallerys extends Model
{
    use HasFactory;
	use ApprovalTraits;
	
    protected $fillable =[
        'title',
        'language',
        'txtuplode',
        'txtstatus',
        'admin_id'

    ];
}
