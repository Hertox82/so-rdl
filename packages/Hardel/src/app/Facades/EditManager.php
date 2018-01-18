<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:39
 */

namespace Hardel\Facades;

use Illuminate\Support\Facades\Facade;

class EditManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'editmanager';
    }
}