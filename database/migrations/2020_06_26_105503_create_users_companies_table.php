<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_companies', function (Blueprint $table) {

            $table->increments('id');
            $table->integer("user_id")->unsigned()->nullable();
            $table->integer("company_id")->unsigned()->nullable();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('users_companies');
    }
}
