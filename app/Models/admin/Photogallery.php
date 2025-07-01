<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class Photogallery extends Model
{
    use HasFactory;
	use ApprovalTraits;
	
    protected $fillable =['title','language','txtuplode','txtstatus','admin_id','create_date','update_date','category_id','eventdate','display_on_home'];
}
