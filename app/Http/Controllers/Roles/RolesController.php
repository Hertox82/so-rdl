<?php
/**
 * Created by PhpStorm.
 * User: hadeluca
 * Date: 28/01/18
 * Time: 02:08
 */

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use DB;

class RolesController extends Controller {
    public function index (Request $request) {

        $idRole = $request->user()->idRole;
        $this->startApp($idRole);

        if($idRole != 1) {
            return redirect(route('dashboard'));
        }

        $listManager = listStart([
            'title' => 'Utenti',
            'subTitle' => 'Elenco degli Utenti',
            'objName' => 'App\Role',
            'input' => $request->all(),
            'orderField' => 'id asc',
            'rowsForPage' => 50,
        ])->addColoumn([
            'label' => 'ID',
            'id' => 'id',
            'width' => '150px'
        ])->addColoumn([
            'label' => 'Nome',
            'id' => 'nome',
            'width' => '250px'
        ]);

        $listManager = $listManager->extract();

        return $listManager->publish();
    }

    public function create(Request $request) {

        return parent::create($request);
    }

    public function edit(Request $request, $id) {

        return parent::edit($request, $id);
    }

    public function buildEditManager(Request $request, $id = null) {

        $idRole = $request->user()->idRole;
        $this->startApp($idRole);

        if($idRole != 1) {
            return redirect(route('dashboard'));
        }

        $editManager = editStart([
            'title' => 'Ruolo',
            'subTitle' => 'Elenco dei Ruoli',
            'objName' => 'App\Role',
            'objId' => $id,
            'input' => $request->all(),
        ])->addLabel([
            'label' => 'Definizioni generali'
        ])->addCp('bl','block',[
            'label' => 'Definizioni generali',
            'icon' => 'fa fa-database',
        ])->addCp('fl','text',[
            'label' => 'Nome',
            'field' => 'nome',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Nome è obbligatorio',
            ],
        ]);


        return $editManager;
    }
}