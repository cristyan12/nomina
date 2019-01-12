<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('code');
            $table->string('name');
            $table->string('account');
            $table->enum('account_type', ['Corriente', 'Ahorro'])->default('Corriente');

            $table->unsignedInteger('first_sign_auth');
            $table->unsignedInteger('first_sign_position');

            $table->unsignedInteger('second_sign_auth')->unique();
            $table->unsignedInteger('second_sign_position')->unique();

            $table->foreign('first_sign_auth')->references('id')->on('employees');
            $table->foreign('second_sign_auth')->references('id')->on('employees');
            
            $table->foreign('first_sign_position')->references('id')->on('positions');
            $table->foreign('second_sign_position')->references('id')->on('positions');

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
        Schema::dropIfExists('banks');
    }
}
