<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApprovalTraits;

class MinistersInfo extends Model
{
    use HasFactory;
	use ApprovalTraits;

    protected $fillable = [
        'ministers_type',
        'room_no',
        'name',
        'designation',
        'office_no',
        'intercom',
        'residence_no',
        'email',
        'txtstatus',
        'admin_id',
        'language',
        'flag_id'
    ];
}
