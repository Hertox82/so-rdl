<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:00
 */

namespace Hardel\Support\Field;


use AbstractField;

class DateField extends AbstractField
{
    protected $view = 'hardel::edit.field.datefield-v1';

    public function saving($value) {
        if(strtotime($value) !== false) {
            $value = date("Y-m-d",strtotime($value));
        }
        else $value = null;
        return $value;
    }
}