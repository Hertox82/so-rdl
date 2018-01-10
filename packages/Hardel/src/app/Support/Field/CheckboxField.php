<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 11:48
 */

namespace Hardel\Support\Field;


use AbstractField;
use DB;


class CheckboxField extends AbstractField
{
    protected $list = [];
    protected $view = 'hardel::edit.field.checkboxfield-v1';
    protected $type = 1;        // Type = 1 salvataggio su tabella
    protected $tblName = null;
    protected $keyMaster = null;
    protected $keySlave = null;
    protected $multiValue = [];

    public function getMultiValue($id) {
        $fieldName = $this->field;
        $list = DB::table($this->tblName)->where($this->keyMaster, $id)->get();
        $keySlave = $this->keySlave;
        $old = old();

        if(count($old) == 0) {
            foreach($list as $item) {
                $this->multiValue[] = $item->$keySlave;
            }
        }
        else {
            foreach($old as $key => $val) {
                if(substr($key,0,strlen($fieldName)) == $fieldName) {
                    $this->multiValue[] = $val;
                }
            }
        }
    }

    public function saved($Obj, $input) {
        $fieldName = $this->field;
        $list = [];

        foreach($input as $key => $val) {
            if(substr($key,0,strlen($fieldName)) == $fieldName) {
                $list[] = $val;
            }
        }

        // Se è previsto il salvataggio nel DB
        if($this->type == 1) {
            $keyMaster = $this->keyMaster;
            $keySlave = $this->keySlave;
            $dbList = DB::table($this->tblName)->where($keyMaster, $Obj->id)->get();
            $ltComplete = [];
            $ltInsert = [];

            foreach($list as $id) {

                $insert = true;
                $ltComplete[] = $id;

                foreach($dbList as $item) {

                    // Se è già presente nella lista non lo inserisce
                    if($item->$keySlave == $id) {
                        $insert = false;
                    }

                }

                if($insert == true) {
                    $ltInsert[] = [$keyMaster => $Obj->id, $keySlave => $id];
                }

            }

            // Inserimento
            if(count($ltInsert) != 0) {
                DB::table($this->tblName)->insert($ltInsert);
            }

            // Eliminazione
            $sql = DB::table($this->tblName)->where($keyMaster, $Obj->id);
            foreach($ltComplete as $id) {
                $sql = $sql->where($keySlave, '<>', $id);
            }
            $sql->delete();
        }
    }
}