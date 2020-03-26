<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNominaIdToEmployeeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_profiles', function (Blueprint $table) {
            $table->unsignedInteger('nomina_id')
                ->after('account_number')
                ->default(0);

            $table->foreign('nomina_id')
                ->references('id')
                ->on('nominas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_profiles', function (Blueprint $table) {
            $table->dropForeign('nomina_id');
            $table->dropColumn('nomina_id');
        });
    }
}
