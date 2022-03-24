<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignidcolumnSoftwarenaalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softwareanalytics', function (Blueprint $table) {
            $table->dropForeign('softwareanalytics_interest_id_foreign');
            $table->dropForeign('softwareanalytics_socialmedia_id_foreign');

            $table->dropColumn(['interest_id']);
            $table->dropColumn(['socialmedia_id']);

        });

        Schema::table('socialmedia_softwareanalytic', function (Blueprint $table) {
            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');
        });

        Schema::table('interest_softwareanalytic', function (Blueprint $table) {
            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
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
