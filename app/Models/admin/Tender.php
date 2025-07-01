<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class Tender extends Model
{
    use HasFactory;
	use ApprovalTraits;
	
    protected $fillable =[
                    'tender_title',
                    'url',
                    'page_url',
                    'is_new',
                    'language',
                    'menutype',
                    'metakeyword',
                    'metadescription',
                    'description',
                    'txtuplode',
                    'txtweblink',
                    'txtstatus',
                    'admin_id',
                    'tendertype',
                    'start_date',
                    'end_date'
                ];

}
