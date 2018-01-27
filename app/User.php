<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use UHModel;

class User extends UHModel
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

    public function gVal($field, $extra = array()) {
        $return = [];

        if($field === 'mun_res') {
            $return[] = ['value' => 1, 'label' => 'Municipio I'];
            $return[] = ['value' => 2, 'label' => 'Municipio II'];
            $return[] = ['value' => 3, 'label' => 'Municipio III'];
            $return[] = ['value' => 4, 'label' => 'Municipio IV'];
            $return[] = ['value' => 5, 'label' => 'Municipio V'];
            $return[] = ['value' => 6, 'label' => 'Municipio VI'];
            $return[] = ['value' => 7, 'label' => 'Municipio VII'];
            $return[] = ['value' => 8, 'label' => 'Municipio VIII'];
            $return[] = ['value' => 9, 'label' => 'Municipio IX'];
            $return[] = ['value' => 10, 'label' => 'Municipio X'];
            $return[] = ['value' => 11, 'label' => 'Municipio XI'];
            $return[] = ['value' => 12, 'label' => 'Municipio XII'];
            $return[] = ['value' => 13, 'label' => 'Municipio XIII'];
            $return[] = ['value' => 14, 'label' => 'Municipio XIV'];
            $return[] = ['value' => 15, 'label' => 'Municipio XV'];
        } else if ($field === 'livello') {
            $return[] = ['value' => 1, 'label' => 'Nessuna Esperienza'];
            $return[] = ['value' => 2, 'label' => 'Con Esperienza'];
            $return[] = ['value' => 3, 'label' => 'Molto Esperto'];
        }

        return $return;
    }
}
