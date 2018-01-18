<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:05
 */

namespace Hardel\Support\Field;


use AbstractField;

class HiddenField extends AbstractField
{
    protected $view = 'hardel::edit.field.hiddenfield-v1';
}