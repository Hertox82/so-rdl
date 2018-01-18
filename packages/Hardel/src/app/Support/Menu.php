<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 10:43
 */

namespace Hardel\Support;

class Menu {

    protected $list = array();

    public function add($args) {

        // Inizializza
        $default = array(
            'label' => null,
            'routeName' => null,
            'icon' => null,
            'openFull' => false,
            'childs' => array(),
        );
        $param = cleanParam($args, $default);

        // Mette in pila
        $this->list[] = $param;

        // Restituisce
        return $this;

    }

    public function addChild($args) {

        // Inizializza
        $default = array(
            'label' => null,
            'routeName' => null,
            'routeParam' => [],
            'icon' => null,
        );
        $param = cleanParam($args, $default);

        // Mette in pila
        $this->list[count($this->list)-1]['childs'][] = $param;

        // Restituisce
        return $this;
    }

    public function get() {

        $return = [];
        foreach ($this->list as $item)
        {
            if(isset($item['routeName']))
            {
                $return[] =$item;
            }
            else
            {
                if(count($item['childs'])>0)
                    $return[] = $item;
            }
        }
        $this->list = $return;

        return $this->list;
    }

}