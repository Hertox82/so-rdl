<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 10:51
 */

namespace Hardel\Support;

use Illuminate\Support\Facades\DB;
use Route;

class ListManager{

    protected $coloums = array();
    protected $search = array();
    protected $table = null;
    protected $leftJoin = array();
    protected $filter = array();
    protected $masterFilter = array();
    protected $list = array();
    protected $orderField = null;
    protected $rowsForPage = null;
    protected $rowsTotal = null;
    protected $activePage = 1;
    protected $input = array();
    protected $generalInfo = array();
    protected $routePrefix = null;
    protected $action = array();
    protected $modalAction = array();
    protected $jsList = array();

    protected $pageFieldName = null;
    protected $orderFieldName = null;
    protected $numofrowFieldName = null;

    protected $actionNew = true;
    protected $massAction = true;

    public function start($args) {

        // Inizializza
        $default = array(
            'objName' => null,
            'leftJoin' => array(),
            'input' => array(),
            'orderField' => null,
            'rowsForPage' => 25,
            'pageFieldName' => 'page',
            'numofrowFieldName' => 'nep',
            'orderFieldName' => 'ord',
            'actionNew' => true,
            'massAction' => true,

            'extends' => 'hardel::master.template',
            'view' => 'hardel::list.standard-v1',
            'title' => 'TITLE',
            'subTitle' => null,
        );
        $param = cleanParam($args, $default);

        // Inizializza
        $Obj = new $param['objName'];

        // Imposta i dati generali
        $this->objName = $param['objName'];
        $this->table = $Obj->getTable();
        $this->orderField = $param['orderField'];
        $this->rowsForPage = $param['rowsForPage'];
        $this->input = $param['input'];
        $this->pageFieldName = $param['pageFieldName'];
        $this->numofrowFieldName = $param['numofrowFieldName'];
        $this->orderFieldName = $param['orderFieldName'];
        $this->leftJoin = $param['leftJoin'];

        $this->actionNew = $param['actionNew'];
        $this->massAction = $param['massAction'];

        $this->generalInfo['extends'] = $param['extends'];
        $this->generalInfo['title'] = $param['title'];
        $this->generalInfo['subTitle'] = $param['subTitle'];
        $this->generalInfo['view'] = $param['view'];

        $this->routePrefix = $this->findRoute();

        // Restituzione
        return $this;
    }

    public function addColoumn($args = array()) {

        // Inizializza
        $default = array(
            'label' => null,
            'id' => null,
            'table' => null,
            'display' => true,
            'type' => 'text',   // text, date, preset, price
            'objName'  => $this->objName,
            'width' => null,
            'join' => false,
            'modelAttribute' => null,
            'alias' => null,
        );
        $param = cleanParam($args, $default);

        // Import della tabella
        if(strlen($param['table']) == 0) $param['table'] = $this->table;

        // Salvataggio dati
        $this->coloums[] = $param;

        // Importa i filtri
        $this->refreshFilter($this->input);

        // Restituzione
        return $this;
    }

    public function addModalAction($args = array())
    {
        $default = [
            'label' => null,
            'icon'  => null,
            'js'    => null,
            'style' => null,
            'id'    => null
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
            $this->modalAction[count($this->modalAction)] = $param;
        }

        return $this;
    }

    public function addSearch($args = array()) {

        // Inizializza
        $default = array(
            'label' => null,
            'id' => null,
            'table' => null,
            'type' => 'text', // text, date, preset,numeric
            'list' => [],
        );
        $param = cleanParam($args, $default);

        // Gestione tabella
        if(strlen($param['table']) == 0) $param['table'] = $this->table;

        // Salvataggio dati
        $this->search[] = $param;

        // Importa i filtri
        $this->refreshFilter($this->input);

        // Restituzione
        return $this;
    }

    public function addAction($args = array()) {

        // Inizializza
        $default = array(
            'label'       => null,
            'icon'        => null,
            'routeAlias'  => null,
            'target'      => null,
            'style'       => null,
            'boolean'     => null,
            'type'        => 'standard', // "standard" è quello che porta in un'altra finestra, "modalAjax"
            'js'          => '',
            'id'          => null
        );
        $param = cleanParam($args, $default);

        if($param['js'] != null)
        {
            $this->jsList[count($this->jsList)] = $param['js'];
        }
        // Salvataggio dati
        $this->action[] = $param;

        // Restituzione
        return $this;
    }

    public function addMasterFilter($args = array()) {
        // Inizializza
        $default = array(
            'id' => null,
            'raw' => null,
        );
        $param = cleanParam($args, $default);

        // Aggiunge in coda a tutti i filtri
        $this->masterFilter[] = $param;

        // Restituzione
        return $this;
    }

    public function refreshFilter($request) {

        // Inizializza
        $filter = array();
        $ObjName = $this->objName;

        // Scansione filtri
        foreach($request as $key => $value) {

            $label = null;
            $type = null;
            $id = null;
            $confirm = false;
            $value2 = null;
            $valuePreset = null;
            $table = null;

            // Cerca il tipo
            if(substr($key,0,2) == 'T_') {
                $type = 'text';
                $id = substr($key,2);
            }
            elseif(substr($key,0,3) == 'D0_') {
                $type = 'date';
                $id = substr($key,3);
                $value2 = $request['D1_' . $id];
            }
            elseif(substr($key,0,3) == 'PR_') {
                $type = 'preset';
                $id = substr($key,3);
                $valuePreset = $ObjName::gValBack($id,$value);
            }
            elseif(substr($key,0,2) == 'N_') {
                $type = 'numeric';
                $id = substr($key,2);
            }

            // Verifica che sia un campo presente
            foreach($this->search as $item) {
                if($id == $item['id']) {
                    $label = $item['label'];
                    $table = $item['table'];
                    $confirm = true;
                }
            }

            // Se è tutto confermato lo somma all'elenco dei filtri
            if($confirm && strlen($value) != 0) {
                $filter[] = [
                    'label' => $label,
                    'id' => $id,
                    'table' => $table,
                    'type' => $type,
                    'value' => $value,
                    'value2' => $value2,
                    'valuePreset' => $valuePreset,
                ];
            }
        }

        // Imposta la pagina attiva
        if(isset($request[$this->pageFieldName]) || key_exists('reset',$request)) {
            if(!key_exists('reset',$request))
                $this->activePage = $request[$this->pageFieldName];

            $this->savePageInSession();
        }
        $this->activePage = $this->getActivePageBySession();

        // Imposta l'ordinamento
        if(isset($request[$this->orderFieldName]) || key_exists('reset',$request)) {
            if(!key_exists('reset',$request))
                $this->orderField = $request[$this->orderFieldName];

            $this->saveOrderInSession();
        }
        $this->orderField = $this->getActiveOrderBySession();

        // Imposta il numero di righe per pagina
        if(isset($request[$this->numofrowFieldName]) || key_exists('reset',$request)) {
            if(!key_exists('reset',$request))
                $this->rowsForPage = $request[$this->numofrowFieldName];

            $this->saveNumofrowInSession();
        }
        $this->rowsForPage = $this->getActiveNumofrowBySession();

        // Se è stato passato almeno un campo valido oppure il campo reset
        $this->filter = $filter;
        if(count($this->filter) != 0 || key_exists('reset',$request)) {
            $this->saveFilterInSession();
        }
        $this->filter = $this->getFilterBySession();

        // Restituzione
        return $this;
    }

    private function saveFilterInSession() {
        session()->put('ListManager_' . $this->table . '_hardel.list', $this->filter);
    }

    private function savePageInSession() {
        session()->put('ListManager_' . $this->table . '_hardel.page', $this->activePage);

        if(!is_numeric($this->getActivePageBySession()) || $this->activePage == 0) {
            $this->activePage = 1;
            session()->put('ListManager_' . $this->table . '_hardel.page', $this->activePage);
        }
    }

    private function saveNumofrowInSession() {
        session()->put('ListManager_' . $this->table . '_hardel.nep', $this->rowsForPage);

        if(!is_numeric($this->getActiveNumofrowBySession())) {
            $this->rowsForPage = 25;
            session()->put('ListManager_' . $this->table . '_hardel.nep', $this->rowsForPage);
        }
    }

    private function saveOrderInSession() {
        session()->put('ListManager_' . $this->table . '_hardel.order', $this->orderField);
    }

    private function getFilterBySession() {
        return session()->get('ListManager_' . $this->table . '_hardel.list', $this->filter);
    }

    private function getActivePageBySession() {
        return session()->get('ListManager_' . $this->table . '_hardel.page',1);
    }

    private function getActiveNumofrowBySession() {
        $return = session()->get('ListManager_' . $this->table . '_hardel.nep',25);
        return $return;
    }

    private function getActiveOrderBySession() {
        return session()->get('ListManager_' . $this->table . '_hardel.order',$this->orderField);
    }

    public function rebuild($list) {

        // Inizializza
        $matchList = array();

        // Scanzione degli elementi
        foreach($list as $item) {

            $objName = $this->objName;
            $Obj = $objName::find($item->id);

            $matchList[] = $Obj;

        }

        //Smo::pr($matchList,1);

        // Restituzione
        return $matchList;

    }

    public function extract() {

        // Inizializza
        $list = DB::table($this->table);
        $listTotal = null;
        $select = array($this->table.'.id');
        $rowsForPage = $this->rowsForPage;

        // Aggiunge le join
        foreach($this->leftJoin as $item) {
            $list = $list->leftJoin($item[0],$item[1],$item[2],$item[3]);
        }

        // Filtri
        if(count($this->filter) != 0) {

            $list = $list->where(function ($query) {

                foreach ($this->filter as $item) {

                    // Se è un campo di ricerca text
                    if ($item['type'] == 'text') {
                        $query->where($item['table'] . '.' . $item['id'], 'LIKE', '%' . $item['value'] . '%');
                    }
                    elseif ($item['type'] == 'date') {
                        $query->where($item['table'] . '.' . $item['id'], '>=', date("Y-m-d", strtotime($item['value'])))
                            ->where($item['table'] . '.' . $item['id'], '<=', date("Y-m-d", strtotime($item['value2'])));
                    }
                    elseif ($item['type'] == 'preset' or $item['type'] == 'numeric') {
                        $query->where($item['table'] . '.' . $item['id'], '=', $item['value']);
                    }

                }

            });

        }

        // Master filter
        if(count($this->masterFilter) != 0) {
            foreach($this->masterFilter as $filter) {
                $list = $list->whereRaw(DB::raw("(" . $filter['raw'] . ")"));
            }
        }

        // Estrazione del totale
        $start = ($this->activePage-1) * $rowsForPage;
        $listTotal = $list->select(DB::raw('count(*) AS tot'))->get();
        while($listTotal[0]->tot <= $start) {
            $this->activePage = $this->activePage - 1;
            $start = ($this->activePage-1) * $rowsForPage;
            $this->savePageInSession();
        }

        // Campo select
        foreach($this->coloums as $item) {
            if($item['join'] == false) {
                $slLabel = (is_null($item['alias'])) ? $item['table'].'.'.$item['id'] : $item['table'].'.'.$item['id'].' AS '.$item['alias'];
                $select[] = $slLabel;
            }
        }
        $list = $list->select($select);

        // Ordinamento
        $order = explode(" ", $this->orderField);
        $orderField = $order[0];
        $orderDir = @$order[1];
        if(strlen($orderDir) == 0) $orderDir = 'asc';
        $list = $list->orderBy($orderField, $orderDir);

        // Estrae e corregge i testi in base al tipo
        $sql = $list->take($rowsForPage)->skip($start)->toSql();
        $list = $list->take($rowsForPage)->skip($start)->get();

        //$list = $this->rebuild($list);

        // Salvataggio in locale
        $this->list = $list;//json_decode(json_encode($list), true);
        $this->rowsTotal = $listTotal[0]->tot;

        // Restituisce
        return $this;
    }

    public function toList() {
        return $this->list;
    }

    public function toListInfo() {
        // Inizializza
        $return = [
            'objName' => $this->objName,
            'activePage' => $this->activePage,
            'rowsForPage' => $this->rowsForPage,
            'pagesTotal' => 0,
            'rowsTotal' => $this->rowsTotal,
            'orderField' => $this->orderField,
            'coloumns' => $this->coloums,
            'search' => $this->search,
            'filter' => $this->filter,
            'action' => $this->action,
            'list' => $this->list,
        ];

        // Calcolo pagine
        $return['pagesTotal'] = (int)($return['rowsTotal'] / $return['rowsForPage']);
        if($return['rowsTotal'] % $return['rowsForPage'] > 0) $return['pagesTotal']++;

        // Restituzione
        return $return;
    }

    public function findRoute() {

        $activeRoute = Route::currentRouteName();
        $exp = explode('.',$activeRoute);

        if(count($exp) == 2) return $exp[0];

    }

    public function publish() {

        return view($this->generalInfo['view'], [
            'listInfo'      => $this->toListInfo(),
            'generalInfo'   => $this->generalInfo,
            'routePrefix'   => $this->routePrefix,
            'createUrl'     => route($this->routePrefix . '.create'),
            'massUrl'       => route('list.massAction'),
            'actionNew'     => $this->actionNew,
            'massAction'    => $this->massAction,
            'jsList'        => $this->jsList,
            'modalAction'   => $this->modalAction,
        ]);

    }
}
