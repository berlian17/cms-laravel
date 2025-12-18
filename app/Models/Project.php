<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function galleries()
    {
        return $this->hasMany(ProjectGallery::class);
    }
}
