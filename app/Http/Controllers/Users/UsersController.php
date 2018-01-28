<?php
/**
 * Created by PhpStorm.
 * User: hadeluca
 * Date: 24/01/18
 * Time: 00:13
 */

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{

    public function index (Request $request) {

        $idRole = $request->user()->idRole;
        $this->startApp($idRole);

        if($idRole == 4 or $idRole == 3) {
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
                'label' => 'Ruolo',
                'id' => 'idRole',
                'width' => '250px',
                'type' => 'preset',
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

        if($idRole == 2) {
            $listManager = $listManager->addMasterFilter([
                'id' => 'idRole',
                'raw'=> 'users.idRole != 1'
            ]);
        }

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

        if($idRole == 4 or $idRole == 3) {
            return redirect(route('dashboard'));
        }

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
                'required' => 'Il campo Nome è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Cognome',
            'field' => 'surname',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Cognome è obbligatorio',
            ],
        ])->addCp('fl','date',[
            'label' => 'Data di Nascita',
            'field' => 'birthdate',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Data di Nascita è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Comune di nascita',
            'field' => 'comune_nasc',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Comune di Nascita è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Codice Fiscale',
            'field' => 'cod_fisc',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Codice Fiscale è obbligatorio',
            ],
        ])->addCp('fl','phone',[
            'label' => 'Telefono',
            'field' => 'phone',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Telefono è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Comune Residenza',
            'field' => 'comune_res',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Comune di Residenza è obbligatorio',
            ],
        ])->addCp('fl','prov',[
            'label' => 'Provincia di Residenza',
            'field' => 'prov_res',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Provincia di Residenza è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Indirizzo Residenza',
            'field' => 'ind_res',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Indirizzo di Residenza è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'CAP',
            'field' => 'cap',
            'validation' => 'required',
            'maxLength' => 5,
            'validationMess' => [
                'required' => 'Il campo CAP è obbligatorio',
            ],
        ])->addCp('fl','select',[
            'label' => 'Municipio di Residenza',
            'field' => 'mun_res',
            'list'  => User::gVals('mun_res')
        ])->addCp('fl','select',[
            'label' => 'Esperienza',
            'field' => 'livello',
            'list'  => User::gVals('livello')
        ])->addCp('fl','text',[
                'label' => 'Sezione Tessera Elettorale',
                'field' => 'sez',
        ])->addCp('fl','textarea',[
            'label' => 'Note',
            'field' => 'note',
        ])->addCp('bl','block',[
            'label' => 'Ruolo',
            'icon' => 'fa fa-users',
        ])->addCp('fl','select',[
            'label' => 'Ruolo',
            'field' => 'idRole',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Ruolo è obbligatorio',
            ],
            'list'  => User::gVals('idRole')
        ]);


        return $editManager;
    }

    public function profilo(Request $request, $id) {
        $idRole = $request->user()->idRole;
        $this->startApp($idRole);
        if($id != $request->user()->id) {
            return redirect(route('dashboard'));
        }
        $editManager = editStart([
            'title' => 'Profilo Utente',
            'subTitle' => 'modifica Profilo Utente',
            'objName' => 'App\User',
            'objId' => $id,
            'routePrefix' => 'profilo',
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
                'required' => 'Il campo Nome è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Cognome',
            'field' => 'surname',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Cognome è obbligatorio',
            ],
        ])->addCp('fl','date',[
            'label' => 'Data di Nascita',
            'field' => 'birthdate',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Data di Nascita è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Comune di nascita',
            'field' => 'comune_nasc',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Comune di Nascita è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Codice Fiscale',
            'field' => 'cod_fisc',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Codice Fiscale è obbligatorio',
            ],
        ])->addCp('fl','phone',[
            'label' => 'Telefono',
            'field' => 'phone',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Telefono è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Comune Residenza',
            'field' => 'comune_res',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Comune di Residenza è obbligatorio',
            ],
        ])->addCp('fl','prov',[
            'label' => 'Provincia di Residenza',
            'field' => 'prov_res',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Provincia di Residenza è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'Indirizzo Residenza',
            'field' => 'ind_res',
            'validation' => 'required',
            'validationMess' => [
                'required' => 'Il campo Indirizzo di Residenza è obbligatorio',
            ],
        ])->addCp('fl','text',[
            'label' => 'CAP',
            'field' => 'cap',
            'validation' => 'required',
            'maxLength' => 5,
            'validationMess' => [
                'required' => 'Il campo CAP è obbligatorio',
            ],
        ])->addCp('fl','select',[
            'label' => 'Municipio di Residenza',
            'field' => 'mun_res',
            'list'  => User::gVals('mun_res')
        ])->addCp('fl','select',[
            'label' => 'Esperienza',
            'field' => 'livello',
            'list'  => User::gVals('livello')
        ])->addCp('fl','text',[
            'label' => 'Sezione Tessera Elettorale',
            'field' => 'sez',
        ])->addCp('fl','textarea',[
            'label' => 'Note',
            'field' => 'note',
        ])->addCp('fl','hidden',[
            'label' => 'Ruolo',
            'field' => 'idRole',
        ]);


        return $editManager->publish();
    }

    public function profiloStore(Request $request) {
        return $this->storeAndUpdate($request);
    }

    public function profiloEdit(Request $request, $id) {
        return $this->storeAndUpdate($request, $id);
    }
}