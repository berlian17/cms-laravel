<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaTag extends Model
{
    use SoftDeletes;
    
    protected $table = 'media_tags';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
