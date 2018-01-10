<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 10:37
 */

namespace Hardel\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

abstract class HModel extends Model
{
    public function gVal($field, $extra = array()) {
        return [];
    }

    public static function gValS($field, $extra = array()) {
        $className = get_called_class();
        $Obj = new $className();
        $list = $Obj->gVal($field, $extra);

        return $list;
    }

    public static function gValBack($field, $id) {

        $className = get_called_class();
        $Obj = new $className();
        $list = $Obj->gVal($field);

        foreach($list as $item) {
            if($item['value'] == $id) {
                return $item['label'];
            }
        }

    }

    public function save(array $options = array()) {

        // Impostazione
        $isCreate = false;

        if(!$this->exists) {
            $isCreate = true;
        }

        // Eventi
        if($isCreate) {
            $this->eventCreating();
        } else {
            $this->eventUpdating();
        }

        // Salvataggio
        parent::save();

        // Eventi
        if($isCreate) {
            $this->eventCreated();
        } else {
            $this->eventUpdated();
        }
    }

    public function eventCreating() {
        //Log::info('CREATING');
    }

    public function eventCreated() {
        //Log::info('CREATED');
    }

    public function eventUpdating() {
        //Log::info('UPDATING');
    }

    public function eventUpdated() {
        //Log::info('UPDATED');
    }

    public function eventAfterAllSave() {
        //Log::info('UPDATED');
    }

    public function eventOtherValidation(Validator $validator, $input)
    {
        //Log::info('OTHERVALIDATION')
        return $validator;
    }
}