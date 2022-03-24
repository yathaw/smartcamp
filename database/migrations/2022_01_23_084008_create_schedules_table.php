<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduletypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->time('time');
            $table->string('color');

            $table->foreignId('scheduletype_id')
                    ->references('id')
                    ->on('scheduletypes')
                    ->onDelete('cascade');

            $table->foreignId('batch_id')
                    ->references('id')
                    ->on('batches')
                    ->onDelete('cascade');

            $table->foreignId('teachersegment_id')
                    ->references('id')
                    ->on('teachersegments')
                    ->onDelete('cascade');

            $table->foreignId('staff_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');


            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
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
        Schema::dropIfExists('schedules');
    }
}
