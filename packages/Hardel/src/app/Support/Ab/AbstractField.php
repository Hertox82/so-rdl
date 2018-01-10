<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 11:04
 */

namespace Hardel\Support\Ab;



abstract class AbstractField
{
    protected $id = null;
    protected $label = null;
    protected $field = null;
    protected $value = null;
    protected $validation = null;
    protected $validationMess = [];
    protected $default = null;
    protected $help = null;
    protected $required = false;
    protected $disabled = false;
    protected $view = null;
    protected $style = null;
    protected $ifNull = 'use';
    protected $prefix = null;

   /* public static function init($args)
    {
        // Inizializza
        $className = get_called_class();
        $Field = new $className();

        foreach($args as $key => $value)
        {
            $Field->setProperty($key, $value);
        }

        // Restituzione
        return $Field;
    }*/

    public function init($args)
    {
        // Inizializza

        foreach($args as $key => $value)
        {
            $this->setProperty($key, $value);
        }

        // Restituzione
        return $this;
    }

    public function setProperty($key, $value) {
        if(property_exists($this,$key)) {

            $this->$key = $value;

            // Se è la validazione
            if($key == 'validation') $this->checkValidation();
        }
    }

    public function getProperty($key) {
        if(property_exists($this,$key)) return $this->$key;
        else return null;
    }

    public function checkValidation() {
        $listOfValidation = explode('|',$this->getProperty('validation'));
        foreach($listOfValidation as $item) {
            if($item == 'required') {
                $this->required = true;
            }
        }
    }


    public function getType()
    {
        $nameClass = get_class($this);
        $nameClass = explode('\\',$nameClass);

        return $nameClass[count($nameClass) -1];
    }

    public function saving($value) {
        return $value;
    }

    public function saved($Obj, $input) {
        return true;
    }
}