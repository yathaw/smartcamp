<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign('schedules_scheduletype_id_foreign');
            $table->dropForeign('schedules_batch_id_foreign');
            $table->dropForeign('schedules_staff_id_foreign');
            $table->dropForeign('schedules_school_id_foreign');

        });

        Schema::dropIfExists('schedules');
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
