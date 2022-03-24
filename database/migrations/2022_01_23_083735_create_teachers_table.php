<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->text('degree');

            $table->foreignId('staff_id')
                    ->references('id')
                    ->on('staff')
                    ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('curriculum_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')
                    ->references('id')
                    ->on('curricula')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('teachers');
    }
}
