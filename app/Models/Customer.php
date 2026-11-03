<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'phone',
        'cv_path',
    ];

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
        ];
    }
}
