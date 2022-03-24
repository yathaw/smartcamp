<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_teacher', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_id')
                    ->references('id')
                    ->on('curricula')
                    ->onDelete('cascade');

            $table->foreignId('teacher_id')
                    ->references('id')
                    ->on('teachers')
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
        Schema::dropIfExists('ranges');
    }
}
