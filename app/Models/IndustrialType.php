<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustrialType extends Model
{
    use SoftDeletes;

    protected $table = 'industrial_types';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
