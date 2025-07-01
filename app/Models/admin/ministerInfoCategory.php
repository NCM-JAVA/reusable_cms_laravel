<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ministerInfoCategory extends Model
{
    use HasFactory;

    protected $table = 'minister_info_categories';

    protected $fillable = [
        'category_name',
        'language',
        'txtstatus',
        'flag_id',
    ];
}
