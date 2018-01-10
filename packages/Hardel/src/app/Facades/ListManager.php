<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:40
 */

namespace Hardel\Facades;

use Illuminate\Support\Facades\Facade;

class ListManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'listmanager';
    }
}