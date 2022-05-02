<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->text('photo');
            $table->text('file');

            $table->foreignId('curriculum_id')
                    ->references('id')
                    ->on('curricula')
                    ->onDelete('cascade')
                    ->after('school_id');

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
        Schema::dropIfExists('lessons');
    }
}
