<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:07
 */

namespace Hardel\Support\Field;


use AbstractField;

class PasswordField extends AbstractField
{
    protected $view = 'hardel::edit.field.passwordfield-v1';
    protected $maxLength = 255;
    protected $ifNull = 'notuse';

    public function saving($value) {
        if(strlen($value) != 0) $value = md5($value);

        return $value;
    }
}