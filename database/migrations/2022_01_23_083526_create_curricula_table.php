<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('status')->nullable();


            $table->foreignId('grade_id')
                    ->references('id')
                    ->on('grades')
                    ->onDelete('cascade');

            $table->foreignId('subject_id')
                    ->references('id')
                    ->on('subjects')
                    ->onDelete('cascade');

            $table->foreignId('subjecttype_id')->nullable();
            $table->foreignId('school_id')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('curricula');
    }
}
