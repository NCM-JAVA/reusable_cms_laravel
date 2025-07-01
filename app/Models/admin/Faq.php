<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class Faq extends Model
{
    use HasFactory;
	use ApprovalTraits;
	
    protected $fillable =['title','url','admin_id', 'page_url','category','language','description','txtstatus'];
}
