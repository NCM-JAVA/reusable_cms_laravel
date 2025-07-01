<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corrigendum extends Model
{
    use HasFactory;
    protected $fillable =[
                    'parent_id',
                    'title',
                    'txtuplode',
                    'type'
                ];

}
