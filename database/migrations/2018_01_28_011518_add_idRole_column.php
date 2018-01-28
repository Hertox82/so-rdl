<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdRoleColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users_roles');
        Schema::table('users', function (Blueprint $table) {
            $table->integer('idRole')->after('status')->default(4)->unsigned();
            $table->foreign('idRole')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('idRole');
        });
        Schema::create('users_roles',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idRole')->unsigned();
            $table->foreign('idRole')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
