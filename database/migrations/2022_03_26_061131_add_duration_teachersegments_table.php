<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationTeachersegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachersegments', function (Blueprint $table) {
            $table->time('duration')->after('id');
            $table->string('bgcolor')->nullable()->after('duration');
            $table->string('txtcolor')->nullable()->after('duration');

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
