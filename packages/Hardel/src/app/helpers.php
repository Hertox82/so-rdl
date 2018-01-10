<?php


/**
 * File Helper per tutto il sistema package
 */

use Illuminate\Support\Facades\Route;

if (! function_exists('pr')){

    function pr($array,$die=false)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';

        if($die) die();
    }
}

if(! function_exists('cleanParam')){

    function cleanParam($param, $default)
    {
        $return = array();
        foreach($default as $key => $value)
        {
            if(isset($param[$key])) $value = $param[$key];
            $return[$key] = $value;
        }
        return $return;
    }
}

if( ! function_exists('findRoute')) {

    function findRoute(){

        $activeRoute = Route::currentRouteName();
        $exp = explode('.',$activeRoute);

        if(count($exp) == 2) return $exp[0];
    }

}

if( ! function_exists('submaskInput')){

    function submaskInput($input, $masterkey, $exclude = []){
        // Inizializza
        $return = [];
        $masterkey = $masterkey . "_";

        // Pulisce gli input
        foreach($input as $key => $value) {
            if(substr($key,0,strlen($masterkey)) == $masterkey) {
                $exp = explode('_',$key);

                if(count($exp) == 2) {
                    $return[$exp[1]] = $value;
                }
                elseif(count($exp) == 3) {
                    if (!in_array($exp[1], $exclude))
                        $return[$exp[1]][$exp[2]] = $value;
                }
            }
        }

        // Restituzione
        return $return;
    }
}

if (! function_exists('listStart')){

    function listStart($params)
    {
        return app('listmanager')->start($params);
    }
}


if (! function_exists('editStart')){

    function editStart($params)
    {
        return app('editmanager')->start($params);
    }
}

if(! function_exists('hMenu')){

    function hMenu(){
        return app('menu');
    }
}

/**
 *  Funzione iterativa per estrarre tutti i nodi appartanente ad un ID
 */
if(!function_exists("splice"))
{
    function splice($arrDati, $idFieldName, $iterationFieldName, $idPadreAttuale, $arrSpliced = array())
    {
        // Scansione array dei nodi
        foreach($arrDati as $nodo)
        {
            if($nodo[$iterationFieldName] == $idPadreAttuale)
            {
                $arrIterSpliced = splice($arrDati, $idFieldName, $iterationFieldName, $nodo[$idFieldName]);
                $arrSpliced[] = array(
                    "arrDati" => $nodo,
                    "arrFigli" => $arrIterSpliced
                );
            }
        }

        // Restituzione
        return $arrSpliced;
    }
}

if(! function_exists('build_iteration_order_array')) {

    function build_iteration_order_array($arrDati, $idFieldName, $iterationFieldName){

        // Inizializza
        $arrReturn = array();
        $idPadreAttuale = 0;
        $countSicurezza = 0;

        // Attiva l'iterazione
        $arrReturn = splice($arrDati, $idFieldName, $iterationFieldName, $idPadreAttuale);

        // Restituzione
        return $arrReturn;
    }
}

if(! function_exists('genericView')) {

    function genericView($data){

        // Restituzione
        return view('hardel::error.generic-error',$data);
    }
}



