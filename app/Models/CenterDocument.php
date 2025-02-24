<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterDocument extends Model
{
    protected $fillable = [
        'user_id',
        'center_id',
        'document',
        'status'
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
}
