<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use HController;

class Controller extends HController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function buildMenu(){

        $menu = hMenu()->add([
            'label' => 'Dashboard',
            'routeName' => 'dashboard',
            'icon' => 'icon-home',
        ]);

        $menu = $menu->get();

        return $menu;
    }
}
