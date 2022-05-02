<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewschedulesTable extends Migration
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
            $table->string('title')->nullable();
            $table->string('day');
            $table->foreignId('teachersegment_id')->nullable();
            $table->foreignId('scheduletype_id')->nullable();

            $table->foreignId('batch_id')
                ->references('id')
                ->on('batches')
                ->onDelete('cascade');

            $table->foreignId('staff_id')
                ->references('id')
                ->on('staff')
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
