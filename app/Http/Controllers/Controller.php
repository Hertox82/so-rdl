<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use HController;
use DB;
use Auth;
use Illuminate\Http\Request;

class Controller extends HController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function buildMenu($id){

        $menu = hMenu()->add([
            'label' => 'Dashboard',
            'routeName' => 'dashboard',
            'icon' => 'icon-home',
        ]);
        if($id != null) {
            $RelUser = DB::table('users_roles')->where(['idUser' => $id])->first();
            if($RelUser->idRole != 3) {
                $menu = $menu->add([
                    'label' => 'Utenti',
                    'routeName' => 'users.index',
                    'icon' => 'fa fa-users',
                ]);
            }
        }else {
            $menu = $menu->add([
                'label' => 'Utenti',
                'routeName' => 'users.index',
                'icon' => 'fa fa-users',
            ]);
        }

        $menu = $menu->get();

        return $menu;
    }
}
