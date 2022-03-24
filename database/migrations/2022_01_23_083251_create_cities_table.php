<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('state_id')
                    ->references('id')
                    ->on('states')
                    ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('townships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('otherlanguage')->nullable();
            $table->foreignId('city_id')
                    ->references('id')
                    ->on('cities')
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
        Schema::dropIfExists('cities');
    }
}
