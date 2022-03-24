<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('grades', function (Blueprint $table) {
        //     $table->string('bgcolor')->nullable()->after('name');
        //     $table->string('txtcolor')->nullable()->after('name');
        // });

        // Schema::table('batches', function (Blueprint $table) {
        //     $table->string('txtcolor')->default('#ffffff')->after('color');
        //     $table->renameColumn('color', 'bgcolor');
        // });

        Schema::table('schedules', function (Blueprint $table) {
            // $table->dropColumn(['date']);
            // $table->string('txtcolor')->after('color');
            $table->renameColumn('color', 'bgcolor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            //
        });
    }
}
