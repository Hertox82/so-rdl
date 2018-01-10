<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 10:44
 */

namespace Hardel\Support;

use Route;
use AbstractField;
use AbstractBlock;

class EditManager{

    protected $objName = null;
    protected $objId = null;
    protected $title = null;
    protected $subtitle = null;
    protected $input = array();
    protected $Obj = null;
    protected $type = null;
    protected $routePrefix = null;
    protected $generalInfo = array();
    protected $label = array();
    protected $jsList = array();
    protected $actions = array();
    protected $routeAfterSave = null;


    protected $old = array();

    public function start($args) {

        // Inizializza
        $default = array(
            'objName' => null,
            'objId' => null,
            'input' => array(),

            'extends' => 'hardel::master.template',
            'view' => 'hardel::edit.standard-v1',
            'title' => null,
            'subTitle' => null,
            'routeAfterSave' => null,
        );
        $param = cleanParam($args, $default);

        // Salvataggio
        $this->objName = $param['objName'];
        $this->objId = $param['objId'];
        $this->title = $param['title'];
        $this->subtitle = $param['subTitle'];
        $this->input = $param['input'];

        $this->generalInfo['extends'] = $param['extends'];
        $this->generalInfo['title'] = $param['title'];
        $this->generalInfo['subTitle'] = $param['subTitle'];
        $this->generalInfo['view'] = $param['view'];
        $this->routeAfterSave = $param['routeAfterSave'];

        $this->routePrefix = $this->findRoute();

        // Gestione sessione old
        $old = old();
        $this->old = $old;

        // Apertura oggetto
        $objName = $this->objName;
        if($objName != null) {
            if (strlen($this->objId) != 0) {
                $this->Obj = $objName::find($this->objId);
                $this->type = 'update';
            } else {
                $this->Obj = new $objName;
                $this->type = 'store';
            }
        }

        // Restituzione
        return $this;
    }

    public function addLabel($args) {
        // Inizializza
        $default = array(
            'label' => 'LABEL N',
        );
        $param = cleanParam($args, $default);

        // Salva sulla classe
        $param['blocks'] = array();
        $this->label[] = $param;

        // Restituzione
        return $this;
    }

    public function addCp($type,$abstract,$params){

        if($type == 'bl')
        {
            return $this->addBlock(app($abstract)->init($params));
        }
        elseif( $type == 'fl')
        {
            return $this->addField(app($abstract)->init($params));
        }
    }

    public function addBlock(AbstractBlock $Block)
    {
        // Inizializza
        $activeLabel = count($this->label)-1;
        $id = count($this->label[$activeLabel]['blocks']) + 1;

        // Salvataggio dell'ID del blocco
        $Block->setProperty('id',$id);
        $Block->setProperty('Obj',$this->Obj);

        // Messa in pila
        $this->label[$activeLabel]['blocks'][] = $Block;
        if(strlen($Block->getProperty('js')) != 0 && !in_array($Block->getProperty('js'), $this->jsList)) {
            $this->jsList[] = $Block->getProperty('js');
        }

        // Restituzione
        return $this;
    }

    public function addAction($args)
    {
        $default = [
            'label' => null,
            'icon' => null,
            'js' => null,
            'style' => null,
            'id'    => null,
        ];

        $param = cleanParam($args,$default);

        //Controllo che ci siano dei js nella action e inserisco tutto nella lista
        if($param['js'] != null)
        {
            $this->jsList[count($this->jsList)] = $param['js'];
        }

        //aggiungo nella lista delle azioni i pulsanti richiesti
        if($param['label'] != null)
        {
            $this->actions[count($this->actions)] = $param;
        }

        // restituzione
        return $this;
    }

    public function addField(AbstractField $Field) {
        // Inizializza
        $activeLabel = count($this->label)-1;
        $activeBlock = count($this->label[$activeLabel]['blocks'])-1;

        // Salvataggio del valore nel field
        $fieldName = $Field->getProperty('field');
        if($this->Obj->exists) {
            $fieldClassName = get_class($Field);
            $exp = explode('\\', $fieldClassName);

            if(key_exists($fieldName,$this->Obj->getAttributes()))
                $Field->setProperty('value', $this->Obj->$fieldName);
            else
                $Field->setProperty('value', $Field->getProperty('default'));

            if($exp[count($exp)-1] == 'CheckboxField') {
                $Field->getMultiValue($this->Obj->id);
            }
        }
        else {
            $Field->setProperty('value', $Field->getProperty('default'));
        }
        $prefix= $Field->getProperty('prefix');

        if($prefix == null)
            $prefix = $this->Obj->getTable();

        $Field->setProperty('id', $prefix . '_' . $fieldName);

        // Messa in pila
        $this->label[$activeLabel]['blocks'][$activeBlock]->addField($Field);

        // Restituzione
        return $this;
    }

    public function findRoute() {

        $activeRoute = Route::currentRouteName();
        $exp = explode('.',$activeRoute);

        if(count($exp) == 2) return $exp[0];

    }

    public function getValidator() {
        // Inizializza
        $response = [
            'rules' => [],
            'mess' => [],
        ];

        // Scansiona i blocchi
        foreach($this->label as $label) {
            foreach($label['blocks'] as $Block) {
                $blockValidator = $Block->getValidator();
                $response['rules'] = array_merge($response['rules'], $blockValidator['rules']);
                $response['mess'] = array_merge($response['mess'], $blockValidator['mess']);
            }
        }

        // Restituzione
        return $response;
    }

    public function getProperty($key) {
        if(property_exists($this,$key)) return $this->$key;
        else return null;
    }

    public function getFromRequest() {
        // Inizializza
        $input = $this->input;
        $prefix = $this->Obj->getTable();
        $return = [];

        // Scansiona i blocchi pre-inserimento
        foreach($this->label as $label) {
            foreach($label['blocks'] as $Block) {
                $input = $Block->saving($input);
            }
        }

        // Scansiona l'input
        foreach($input as $key => $value) {
            if(substr($key,0,strlen($prefix)) == $prefix) {
                $return[substr($key, strlen($prefix)+1)] = $value;
            }
        }

        // Restituisce
        return $return;
    }

    public function getBlocks() {
        // Inizializza
        $return = [];

        // Scansiona i blocchi pre-inserimento
        foreach($this->label as $label) {
            foreach($label['blocks'] as $Block) {
                $return[] = $Block;
            }
        }

        // Restituzione
        return $return;
    }

    /**
     * @return array
     * La funzione restituisce l'elenco delle funzioni sul controller da richiamare
     */
    public function getFunction() {
        // Inizializza
        $funcList = [
            'saved' => [],
        ];

        // Scansiona i blocchi pre-inserimento
        foreach($this->label as $label) {
            foreach($label['blocks'] as $Block) {
                if(strlen($Block->savedFunction) != 0) {
                    $funcList['saved'][] = $Block->savedFunction;
                }
            }
        }

        // Restituzione
        return $funcList;
    }

    public function getObj() {
        return $this->Obj;
    }

    public function publish() {

        // Inizializza
        $activeLabel = 0;

        // Individuazione routing
        $submitUrl = route($this->routePrefix . '.store');
        $method = 'POST';
        if($this->type == 'update') {
            $submitUrl = route($this->routePrefix . '.update', $this->objId);
            $method = 'PUT';
        }

        // Restituzione view
        return view($this->generalInfo['view'], [
            'generalInfo' => $this->generalInfo,
            'label' => $this->label,
            'activeLabel' => $activeLabel,
            'method' => $method,
            'Obj' => $this->getObj(),
            'listUrl' => route($this->routePrefix . '.index'),
            'submitUrl' => $submitUrl,
            'jsList' => $this->jsList,
            'actions' => $this->actions
        ]);
    }
}