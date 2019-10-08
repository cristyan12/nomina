<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('load_familiars', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->string('name');
            $table->enum('relationship', ['Hijo', 'Hija', 'Pareja', 'Madre', 'Padre']);
            $table->string('document');
            $table->enum('sex', ['M', 'F']);
            $table->date('born_at');
            $table->enum('instruction', ['Maternal', 'Estudiante', 'Bachiller', 'TSU', 'Licenciado o Ingeniero']);
            $table->text('reference')->nullable();

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
        Schema::dropIfExists('load_familiars');
    }
}
