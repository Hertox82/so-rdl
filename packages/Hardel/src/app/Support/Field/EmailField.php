<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:03
 */

namespace Hardel\Support\Field;


use AbstractField;

class EmailField extends AbstractField
{
    protected $view = 'hardel::edit.field.emailfield-v1';
    protected $maxLength = 255;

    public function saving($value) {
        return strtolower($value);
    }
}