<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('bank_id');
            $table->string('number', 20)->unique();
            $table->enum('type', ['Ahorro', 'Corriente'])->default('Corriente');
            $table->unsignedInteger('auth_1');
            $table->unsignedInteger('auth_2')->nullable();
            $table->unsignedInteger('user_id');

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('accounts');
    }
}
