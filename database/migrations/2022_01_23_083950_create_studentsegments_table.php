<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('codeno');
            $table->string('name');
            $table->string('color');

            $table->foreignId('section_id')
                    ->references('id')
                    ->on('sections')
                    ->onDelete('cascade');

            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('batch_syllabi', function (Blueprint $table) {
            $table->id();
            $table->string('status');

            $table->foreignId('batch_id')
                    ->references('id')
                    ->on('syllabi')
                    ->onDelete('cascade');

            $table->foreignId('syllabus_id')
                    ->references('id')
                    ->on('syllabi')
                    ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('studentsegments', function (Blueprint $table) {
            $table->id();
            $table->string('rollno');
            $table->string('type'); // Student type (old/ new)

            $table->foreignId('student_id')
                    ->references('id')
                    ->on('students')
                    ->onDelete('cascade');

            $table->foreignId('batch_id')
                    ->references('id')
                    ->on('batches')
                    ->onDelete('cascade');
                    
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('studentsegment_syllabi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('studentsegment_id')
                    ->references('id')
                    ->on('studentsegments')
                    ->onDelete('cascade');

            $table->foreignId('syllabus_id')
                    ->references('id')
                    ->on('syllabi')
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
        Schema::dropIfExists('studentsegments');
    }
}
