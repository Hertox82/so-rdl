<?php
/**
 * Created by PhpStorm.
 * User: hadeluca
 * Date: 27/01/18
 * Time: 00:28
 */

namespace Hardel\Support\Field;


use AbstractField;

class PhoneField extends AbstractField
{
    protected $view = 'hardel::edit.field.phonefield-v1';
    protected $maxLength = 255;

}