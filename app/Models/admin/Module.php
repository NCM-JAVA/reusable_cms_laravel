<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class Module extends Model
{
    use HasFactory;
	use ApprovalTraits;
	
    protected $fillable =['module_id','submenu_id','slug','module_name','mod_order_id','module_status','publish_id_module','icons','module_language_id','page_type','page_url'];

}
