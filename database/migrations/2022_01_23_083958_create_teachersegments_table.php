<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachersegments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('section_id')
                    ->references('id')
                    ->on('sections')
                    ->onDelete('cascade');

            $table->foreignId('batch_id')
                    ->references('id')
                    ->on('batches')
                    ->onDelete('cascade');

            $table->foreignId('curriculum_id')
                    ->references('id')
                    ->on('curricula')
                    ->onDelete('cascade');

            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');


            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreignId('staff_id')
                    ->references('id')
                    ->on('staff')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('teachersegments');
    }
}
