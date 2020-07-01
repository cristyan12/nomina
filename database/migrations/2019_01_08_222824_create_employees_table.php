<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code');
            $table->string('document');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('rif');
            $table->date('born_at');

            $table->enum('civil_status', [
                'Casado/a', 'Soltero/a', 'Divorciado/a', 'Viudo/a'
            ])->default('Soltero/a');

            $table->enum('sex', ['M', 'F']);

            $table->enum('nationality', ['V', 'E']);

            $table->string('city_of_born');
            $table->date('hired_at');
            $table->unsignedInteger('nomina_id');
            $table->foreign('nomina_id')->references('id')->on('nominas');

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
        Schema::dropIfExists('employees');
    }
}
