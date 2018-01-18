<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','surname','birthdate', 'comune_nasc',
        'cod_fisc',
        'phone',
        'comune_res',
        'prov_res',
        'ind_res',
        'cap',
        'livello',
        'sez',
        'verifyToken',
        'mun_res',
        'note'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
