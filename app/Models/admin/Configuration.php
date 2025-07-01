<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable =[
                    'language',
                    'sms_url',
                    'sender_name',
                    'sender_mail',
                    'cof_type',
                    'password',
                    'port',
                    'contact_msg',
                    'reset_pass_msg',
                    'reg_msg',
                    'feedback_msg',
                    'status'
                ];
}
