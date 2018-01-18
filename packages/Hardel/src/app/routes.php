<?php
/**
 * Created by PhpStorm.
 * User: hernan
 * Date: 09/06/2017
 * Time: 11:45
 */

Route::group(['prefix'=>'/list'],function(){
    Route::any('/massAction',[
        'as' => 'list.massAction',
        'uses'=>'Hardel\Controllers\ListController@massAction'
    ]);
});