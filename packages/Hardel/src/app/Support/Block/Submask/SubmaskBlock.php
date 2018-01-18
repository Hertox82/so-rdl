<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 11:28
 */

namespace Hardel\Support\Block\Submask;


use AbstractBlock;

class SubmaskBlock extends AbstractBlock
{
    protected $view = 'smo017::edit.block.submask.submaskblock-v1';
    protected $js = 'smo017::edit.block.submask.submaskblock-JS-v1';
    protected $urlList = null;
    protected $modalView = null;
    protected $urlModalSubmit = null;
}