<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 10:03
 */

namespace Hardel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Route;
use Validator;

class HardelController extends BaseController
{
    public function __construct(Request $request)
    {
        // Avvia l'applicazione
        $this->startApp();
    }

    public function startApp($id=null){

        // Condivisione menu
        $hMenu = array();
        if(method_exists($this, 'buildMenu')) {
            $hMenu = $this->buildMenu($id);
        }
        view()->share('hMenu', $hMenu);

        // Condivisione rotta attiva
        view()->share('activeRoute', Route::currentRouteName());

    }

    public function create(Request $request) {
        $editManager = $this->buildEditManager($request);
        return $editManager->publish();
    }

    public function edit(Request $request, $id) {
        $editManager = $this->buildEditManager($request, $id);
        return $editManager->publish();
    }

    public function store(Request $request) {
        return $this->storeAndUpdate($request);
    }

    public function update(Request $request, $id) {
        return $this->storeAndUpdate($request, $id);
    }

    public function storeAndUpdate(Request $request, $id = null) {
        // Inizializza
        $editManager = $this->buildEditManager($request, $id);
        $validatorInfo = $editManager->getValidator();
        $Obj = $editManager->getObj();
        $input = $request->all();

        if($id !== null) {
            $input['id'] = $id;
        }

        // Validazione di base sui campi
        $validator = Validator::make($input, $validatorInfo['rules'], $validatorInfo['mess']);

        $validator = $Obj->eventOtherValidation($validator,$input);

        // Se ci sono degli errori di validazione
        if ($validator->fails()) {
            if($id === null) {
                $route = findRoute() . '.create';
                return redirect()->route($route)
                    ->withErrors($validator)
                    ->withInput();
            }
            elseif($id !== null) {
                $route = findRoute() . '.edit';
                return redirect()->route($route, $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        // Se non ci sono errori
        else {
            // Esegue il salvataggio di tutti i campi diretti
            $listOfFields = $editManager->getFromRequest();
            $listOfFuncts = $editManager->getFunction();
            $listOfBlocks = $editManager->getBlocks();

            foreach ($listOfFuncts['beforeSave'] as $name)
            {
                $this->$name($Obj,$request);
            }
            // Imposta i valori nell'oggetto
            foreach($listOfFields as $key => $value) {
                $Obj->$key = $value;
            }

            // Salvataggio
            $Obj->save();

            // Operazioni di post salvataggio
            foreach($listOfFuncts['saved'] as $name) {
                $this->$name($Obj, $request);
            }

            // Esegue la funzione di post salvataggio sui campi
            foreach($listOfBlocks as $Block) {
                $Block->saved($Obj, $input);
            }

            // Esegue le operazioni di chiusura
            $Obj->eventAfterAllSave();

            // Redirect
            $route = findRoute() . '.edit';
            if(isset($request['_return'])) {
                if($request['_return'] == 1) $route = findRoute() . '.index';
                elseif($request['_return'] == 2) $route = $editManager->getProperty('routeAfterSave');
            }
            return redirect()->route($route, $Obj->id);
        }
    }

    public function buildEditManager(Request $request, $id = null) {
        $EditManager = EditManager::start([]);
        return $EditManager;
    }
}


