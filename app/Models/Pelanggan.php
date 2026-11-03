<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Pelanggan extends Model
{
    protected $table      = 'Pelanggan';
    protected $primaryKey = 'Pelanggan_id';
    protected $fillable   = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'phone',
    ];
}
