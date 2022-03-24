<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnSoftwarenaalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('socaillink');
        });

        Schema::table('school_socialmedia', function (Blueprint $table) {
            $table->text('link')->nullable()->after('id');
        });

        Schema::table('softwareanalytics', function (Blueprint $table) {

            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');
        });

        Schema::create('socialmedia_softwareanalytic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socialmedia_id')
                    ->references('id')
                    ->on('socialmedias')
                    ->onDelete('cascade');

            $table->foreignId('softwareanalytic_id')
                    ->references('id')
                    ->on('softwareanalytics')
                    ->onDelete('cascade');
        });

        Schema::create('interest_softwareanalytic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interest_id')
                    ->references('id')
                    ->on('interests')
                    ->onDelete('cascade');

            $table->foreignId('softwareanalytic_id')
                    ->references('id')
                    ->on('softwareanalytics')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
