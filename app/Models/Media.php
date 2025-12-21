<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function mediaTags()
    {
        return $this->hasMany(MediaTag::class);
    }
}
