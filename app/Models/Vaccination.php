<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccination extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name_of_vaccine',
        'registration_type',
        'date_of_first_dose',
        'date_of_second_dose',
        'date_of_registration',
        'antibody_last_date',
        'status',
        'user_id',
        'center_id',
        'serve_by_id',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function firstServedBy()
    {
        return $this->belongsTo(User::class, 'first_served_by_id');
    }

    public function secondServedBy()
    {
        return $this->belongsTo(User::class, 'second_served_by_id');
    }
}
