<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 07/06/2017
 * Time: 16:55
 */

namespace Hardel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class ListController extends Controller
{
    public function massAction(Request $request)
    {
        // Inizializza
        $input = $request->all();
        $id = $input['id'];
        $objName = $input['objName'];

        // Procede alla cancellazione
        $expId = explode("-",$id);
        foreach($expId as $objId) {
            if(strlen($objId) != 0) {
                $Obj = $objName::find($objId);

                if ($Obj !== null ) {
                    $Obj->delete();
                }
            }
        }

        // Restituzione
        return 1;
    }
}