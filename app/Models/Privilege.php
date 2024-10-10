<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Privilege extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'role_id',
        'menu_id',
        'view',
        'add',
        'edit',
        'delete',
        'other',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
