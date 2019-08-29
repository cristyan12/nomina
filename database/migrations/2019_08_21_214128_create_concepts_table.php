<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id'); 
            $table->string('name');
            $table->enum('type', ['asignacion', 'deduccion']);
            $table->text('description');
            $table->float('quantity', 10, 2);
            $table->string('calculation_salary');
            $table->string('formula');

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
        Schema::dropIfExists('concepts');
    }
}
