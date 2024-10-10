<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'sequence',
        'icon',
        'url',
        'group_menu_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
