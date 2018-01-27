<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 12:31
 */

return [
    'ListManager'           => Hardel\Facades\ListManager::class,
    'EditManager'           => Hardel\Facades\EditManager::class,
    'Menu'                  => Hardel\Facades\Menu::class,
    'HModel'                => Hardel\Support\HModel::class,
    'UHModel'               => Hardel\Support\UHModel::class,
    'HController'           => Hardel\Controllers\HardelController::class,
    'AbstractBlock'         => Hardel\Support\Ab\AbstractBlock::class,
    'AbstractField'         => Hardel\Support\Ab\AbstractField::class,
    'Block'                 => Hardel\Support\Block\Base\Block::class,
    'SubmaskBlock'          => Hardel\Support\Block\Submask\SubmaskBlock::class,
    'SubmaskBlockAJ'        => Hardel\Support\Block\Submask\SubmaskBlockAjax::class,
    'TextF'                 => Hardel\Support\Field\TextField::class,
    'HiddenF'               => Hardel\Support\Field\HiddenField::class,
    'TextareaF'             => Hardel\Support\Field\TextareaField::class,
    'EmailF'                => Hardel\Support\Field\EmailField::class,
    'DateF'                 => Hardel\Support\Field\DateField::class,
    'SelectF'               => Hardel\Support\Field\SelectField::class,
    'CheckboxF'             => Hardel\Support\Field\CheckboxField::class,
    'PriceF'                => Hardel\Support\Field\PriceField::class,
    'PasswordF'             => Hardel\Support\Field\PasswordField::class,
];

?>