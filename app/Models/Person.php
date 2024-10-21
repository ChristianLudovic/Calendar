<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['name', 'birthDate', 'avatarId', 'user_id'];

    protected $casts = [
        'birthDate' => 'date',
    ];

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birthDate'] = date('Y-m-d', strtotime($value));
    }

    public function getBirthDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
