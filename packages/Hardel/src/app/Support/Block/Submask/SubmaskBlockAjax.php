<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 11:30
 */

namespace Hardel\Support\Block\Submask;


use AbstractBlock;

class SubmaskBlockAjax extends AbstractBlock
{
    protected $view = 'hardel::edit.block.submask.submaskblock-ajax-v1';
    protected $js = 'hardel::edit.block.submask.submaskblock-ajax-JS-v1';
    protected $viewList = null;
    protected $viewModal = null;
    protected $urlModalSubmit = null;
    protected $share = [];

    public function init($args)
    {
        // Salva in sessione l'old
        $old = old();
        if(count($old) > 0) {
            session()->put('SubmaskBlockAjax.old', $old);
        }

        return parent::init($args);
    }
}