<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareanalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('socialmedias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('logo');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('softwareanalytics', function (Blueprint $table) {
            $table->id();
            $table->text('reason');

            $table->foreignId('interest_id')
                    ->references('id')
                    ->on('interests')
                    ->onDelete('cascade');

            $table->foreignId('socialmedia_id')
                    ->references('id')
                    ->on('socialmedias')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('softwareanalytics');
    }
}
