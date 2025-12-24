<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
    protected $table = 'contact_mails';

    protected $fillable = [
        'status',
        'read_at',
    ];

    protected $casts = [
        'read_at'       => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function markAsRead()
    {
        $this->update([
            'status'    => 'read',
            'read_at'   => now(),
        ]);
    }
}
