<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectGallery extends Model
{
    use SoftDeletes;

    protected $table = 'project_galleries';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
