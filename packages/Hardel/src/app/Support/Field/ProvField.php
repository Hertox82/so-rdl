<?php
/**
 * Created by PhpStorm.
 * User: hadeluca
 * Date: 27/01/18
 * Time: 00:49
 */

namespace Hardel\Support\Field;


use AbstractField;

class ProvField extends AbstractField
{
    protected $view = 'hardel::edit.field.textfield-v1';
    protected $maxLength = 2;

    public function saving($value) {

        return strtoupper($value);
    }
}