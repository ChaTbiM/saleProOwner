<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("module_id")->unsigned()->nullable();
            $table->integer("company_id")->unsigned()->nullable();
            
            $table->foreign('module_id')
            ->references('id')
            ->on('modules')
            ->onDelete('cascade');

            $table->foreign('company_id')
            ->references('id')
            ->on('companies')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies_modules');
    }
}
