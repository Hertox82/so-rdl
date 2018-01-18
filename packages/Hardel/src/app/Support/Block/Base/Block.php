<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 11:02
 */

namespace Hardel\Support\Block\Base;

use AbstractBlock;
use AbstractField;

class Block extends AbstractBlock
{

    protected $view = 'hardel::edit.block.base.block-v1';
    protected $fields = array();

    public function addField(AbstractField $Field) {
        $this->fields[] = $Field;
    }

    public function getFields() {
        return $this->fields;
    }

    public function getValidator() {
        // Inizializza
        $response = [
            'rules' => [],
            'mess' => [],
        ];

        // Per ogni campo
        foreach($this->getFields() as $Field) {
            if(strlen($Field->getProperty('validation')) != 0 && $Field->getProperty('disabled') == false) {
                $response['rules'][$Field->getProperty('id')] = $Field->getProperty('validation');
            }
            if(count($Field->getProperty('validationMess')) != 0) {
                foreach($Field->getProperty('validationMess') as $key => $mess) {
                    $response['mess'][$Field->getProperty('id') . '.' . $key] = $mess;
                }
            }
        }

        // Restituzione
        return $response;
    }

    public function searchInFields($id) {
        $list = $this->getFields();
        foreach($list as $Field) {
            if($Field->getProperty('id') == $id)
            {
                return $Field;
            }
        }
        return null;
    }

    public function saving($input) {
        // Inizializza
        $return = [];

        // Per ogni valore passato
        foreach($input as $key => $value) {
            $Field = $this->searchInFields($key);
            $setTheKey = true;

            if($Field !== null) {
                $value = $Field->saving($value);

                if(strlen($value) == 0 && $Field->getProperty('ifNull') == 'notuse')
                    $setTheKey = false;
            }

            if($setTheKey)
                $return[$key] = $value;
        }

        // Restituzione
        return $return;
    }

    public function saved($Obj, $input) {
        // Per ogni campo
        foreach($this->fields as $Field) {
            $Field->saved($Obj, $input);
        }
    }
}