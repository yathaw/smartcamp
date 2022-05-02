<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordings', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('file');

            $table->foreignId('batch_id')
                    ->references('id')
                    ->on('batches')
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
        Schema::dropIfExists('recordings');
    }
}
