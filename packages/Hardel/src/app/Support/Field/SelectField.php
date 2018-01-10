<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:15
 */

namespace Hardel\Support\Field;


use AbstractField;

class SelectField extends AbstractField
{
    protected $list = [];
    protected $size = 1;
    protected $defaultValue = 1;
    protected $view = 'hardel::edit.field.selectfield-v1';
}