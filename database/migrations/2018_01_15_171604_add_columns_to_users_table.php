<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('name');
            $table->date('birthdate')->after('surname');
            $table->string('comune_nasc')->after('birthdate');
            $table->string('cod_fisc')->after('comune_nasc');
            $table->string('phone')->after('cod_fisc');
            $table->string('comune_res')->after('phone');
            $table->string('prov_res')->after('comune_res');
            $table->string('ind_res')->after('prov_res');
            $table->string('cap')->after('ind_res');
            $table->integer('mun_res')->unsigned()->after('cap')->nullable();
            $table->tinyInteger('livello')->unsigned()->default(1)->after('mun_res');
            $table->string('sez')->nullable()->after('livello');
            $table->text('note')->after('sez')->nullable();
            $table->string('verifyToken')->nullable()->after('note');
            $table->boolean('status')->after('verifyToken')->default(0);

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
            $table->dropColumn('surname');
            $table->dropColumn('birthdate');
            $table->dropColumn('comune_nasc');
            $table->dropColumn('cod_fisc');
            $table->dropColumn('phone');
            $table->dropColumn('comune_res');
            $table->dropColumn('prov_res');
            $table->dropColumn('ind_res');
            $table->dropColumn('cap');
            $table->dropColumn('mun_res');
            $table->dropColumn('livello');
            $table->dropColumn('sez');
            $table->dropColumn('note');
            $table->dropColumn('verifyToken');
            $table->dropColumn('status');
        });
    }
}
