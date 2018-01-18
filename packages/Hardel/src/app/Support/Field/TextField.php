<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:19
 */


namespace Hardel\Support\Field;


use AbstractField;

class TextField extends AbstractField
{
    protected $view = 'hardel::edit.field.textfield-v1';
    protected $maxLength = 255;
}