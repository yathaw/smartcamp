<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('logo')->nullable();
            $table->text('coverphoto')->nullable();
            $table->text('certificate')->nullable();
            $table->text('about')->nullable();
            $table->string('mottoes')->nullable();
            $table->date('established')->nullable();
            $table->text('facilities')->nullable();
            $table->text('address')->nullable();

            $table->foreignId('city_id')->nullable();

            $table->foreignId('schooltype_id')->nullable();

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
        Schema::dropIfExists('schools');
    }
}
