<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolidToScheduletypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scheduletypes', function (Blueprint $table) {
            $table->foreignId('school_id')
                    ->after('name')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->after('name')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });

        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');

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
        Schema::table('scheduletypes', function (Blueprint $table) {
            //
        });
    }
}
