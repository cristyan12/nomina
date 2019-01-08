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

            $table->enum('marital_status', [
                'Casado/a', 'Soltero/a', 'Viudo/a'
            ])->default('Soltero/a');

            $table->enum('sex', ['M', 'F']);
            $table->string('nationality')->default('Venezolana');
            $table->string('city_of_born');

            $table->date('hired_at');
            $table->unsignedInteger('profession_id');
            $table->unsignedInteger('contract_id');

            $table->enum('status', [
                'Activo', 'Suspendido', 'Retirado'
            ])->default('Activo');

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
