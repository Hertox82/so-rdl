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
            if($id === 1 or $id === 2) {
                $menu = $menu->add([
                    'label' => 'Utenti',
                    'routeName' => 'users.index',
                    'icon' => 'fa fa-users',
                ]);
                if($id === 1) {
                    $menu = $menu->add([
                        'label' => 'Ruoli',
                        'routeName' => 'roles.index',
                        'icon' => 'fa fa-graduation-cap',
                    ]);
                }
            }
        }

        $menu = $menu->get();

        return $menu;
    }
}
