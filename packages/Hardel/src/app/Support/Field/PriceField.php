<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:09
 */

namespace Hardel\Support\Field;


use AbstractField;

class PriceField extends AbstractField
{
    protected $view = 'hardel::edit.field.pricefield-v1';
    protected $maxLength = 255;

    public function saving($value) {
        $value = str_replace(",",".",$value);
        $value = number_format($value, 2, ".", "");

        return $value;
    }
}