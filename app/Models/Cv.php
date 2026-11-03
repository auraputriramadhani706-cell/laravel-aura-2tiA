<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'nama', 'jabatan', 'ringkasan', 'email', 'telepon', 'alamat',
        'website', 'pendidikan', 'pengalaman', 'skill', 'sertifikasi', 'foto',
    ];
}
