<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->time('time');
            $table->string('bgcolor');
            $table->string('txtcolor');
            
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
        Schema::dropIfExists('schedule');
    }
}
