<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('codeno');
            $table->string('price')->nullable();
            $table->string('pricetype')->nullable();
            $table->date('startdate');
            $table->date('enddate');
            $table->time('starttime');
            $table->time('endtime');


            $table->foreignId('period_id')
                    ->references('id')
                    ->on('periods')
                    ->onDelete('cascade');

            $table->foreignId('grade_id')
                    ->references('id')
                    ->on('grades')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
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
        Schema::dropIfExists('sections');
    }
}
