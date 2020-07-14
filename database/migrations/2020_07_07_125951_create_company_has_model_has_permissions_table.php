<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCompanyHasModelHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_has_user_has_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned()->nullable();
            $table->string("permission_name")->nullable();
            $table->string("company_name")->nullable();


            // $table->foreign('company_permissions_id')
            //     ->references('role_id' . 'model_id' . 'model_type')
            //     ->on('model_has_permissions')
            //     ->onDelete('restrict');

           

            // $table->foreign('company_id')
            //     ->references('id')
            //     ->on('companies')
            //     ->onDelete('restrict');
            $table->timestamps();
        });


        // Schema::table('company_has_model_has_permissions', function (Blueprint $table) {
        //     DB::raw('
        //     add constraint  `fk_company_permissions_id`
        //     foreign key (company_permissions_id)
        //      references model_has_permissions  (permission_id, model_id, model_type)
        //     '); 
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_has_user_has_permissions');
    }
}
