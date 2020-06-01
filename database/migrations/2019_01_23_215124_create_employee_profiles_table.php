<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('nomina_id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('profession_id');

            $table->enum('contract', ['T', 'I'])->default('T');

            $table->enum('status', [
                'Activo', 'Vacaciones', 'Reposo', 'Liquidado', 'Suspendido', 'Fallecido', 'Eliminado'
            ])->default('Activo');

            $table->unsignedInteger('bank_id');
            $table->string('account_number');

            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('position_id');

            // Foreigns
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('professions');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('position_id')->references('id')->on('positions');
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
        Schema::dropIfExists('employee_profiles');
    }
}
