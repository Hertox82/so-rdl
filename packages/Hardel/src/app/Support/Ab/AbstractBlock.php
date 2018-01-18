<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 11:00
 */

namespace Hardel\Support\Ab;


abstract class AbstractBlock
{
    protected $id = null;
    protected $label= 'BLOCK N';
    protected $icon = null;
    protected $view = null;
    protected $js = null;
    protected $Obj = null;
    protected $savedFunction = null;
    protected $beforeSaveFunction = null;

    /*public static function init($args)
    {
        // Inizializza
        $className = get_called_class();
        $Block = new $className();

        foreach($args as $key => $value)
        {
            $Block->setProperty($key, $value);
        }

        // Restituzione
        return $Block;
    }*/

    public function init($args)
    {
        // Inizializza
        //$className = get_called_class();
        //$Block = new $className();

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
        }
    }

    public function getProperty($key) {
        if(property_exists($this,$key)) return $this->$key;
        else return null;
    }

    public function __get($key) {
        if(property_exists($this,$key)) return $this->$key;
        else return null;
    }

    public function getValidator() {
        return [
            'rules' => [],
            'mess' => [],
        ];
    }

    /**
     * @param $input
     * @return mixed
     * Funzione eseguita su ogni campo del blocco prima del salvataggio
     */
    public function saving($input) {
        return $input;
    }

    /**
     * @param $input
     * @return mixed
     * Funzione eseguita su ogni campo del blocco dopo il salvataggio
     */
    public function saved($Obj, $input) {

    }
}