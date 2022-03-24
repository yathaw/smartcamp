<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('startdate');
            $table->date('enddate');
            $table->text('rule');


            $table->foreignId('batch_id')
                    ->references('id')
                    ->on('batches')
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

        Schema::create('examdetails', function (Blueprint $table) {
            $table->id();
            $table->time('starttime');
            $table->time('endtime');

            $table->foreignId('exam_id')
                    ->references('id')
                    ->on('exams')
                    ->onDelete('cascade');

            $table->foreignId('syllabus_id')
                    ->references('id')
                    ->on('syllabi')
                    ->onDelete('cascade');

            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade'); // exam wait teacher

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
        Schema::dropIfExists('exams');
    }
}
