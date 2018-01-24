<?php
/**
 * Created by PhpStorm.
 * User: hadeluca
 * Date: 24/01/18
 * Time: 00:13
 */

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{

    public function index (Request $request) {

        $id = $request->user()->id;


        $RelUser = DB::table('users_roles')->where(['idUser' => $id])->first();
        $this->startApp($id);

        if($RelUser->idRole == 3) {
            return redirect(route('dashboard'));
        }

            $listManager = listStart([
                'title' => 'Utenti',
                'subTitle' => 'Elenco degli Utenti',
                'objName' => 'App\User',
                'input' => $request->all(),
                'orderField' => 'surname asc',
                'rowsForPage' => 50,
            ])->addColoumn([
                'label' => 'Nome',
                'id' => 'name',
                'width' => '250px'
            ])->addColoumn([
                'label' => 'Cognome',
                'id' => 'surname',
                'width' => '250px'
            ])->addColoumn([
                'label' => 'Prov',
                'id' => 'prov_res',
                'width' => '250px'
            ])->addColoumn([
                'label' => 'Comune',
                'id' => 'comune_res',
                'width' => '250px'
            ])->addColoumn([
                'label' => 'Email',
                'id' => 'email',
                'width' => '250px'
            ])->addSearch([
                'label' => 'Nome',
                'id' => 'name',
            ])->addSearch([
                'label' => 'Prov',
                'id' => 'prov_res',
            ])->addSearch([
                'label' => 'Cognome',
                'id' => 'surname',
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

        $editManager = editStart([
            'title' => 'Utente',
            'subTitle' => 'Elenco degli Utenti',
            'objName' => 'App\User',
            'objId' => $id,
            'input' => $request->all(),
        ])->addLabel([
            'label' => 'Definizioni generali'
        ])->addCp('bl','block',[
            'label' => 'Definizioni generali',
            'icon' => 'fa fa-database',
        ])->addCp('fl','text',[
            'label' => 'Nome',
            'field' => 'name',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo nome è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Cognome',
            'field' => 'surname',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo nome è obbligatorio',
            ],
        ])->addCp('fl','date',[
            'label' => 'Data di Nascita',
            'field' => 'birthdate',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo nome è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Comune di nascita',
            'field' => 'comune_nasc',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo nome è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Codice Fiscale',
            'field' => 'cod_fisc',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo nome è obbligatorio',
            ],
        ]);


        return $editManager;
    }
}