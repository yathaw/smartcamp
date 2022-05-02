<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnsToExamdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examdetails', function (Blueprint $table) {
            $table->dropColumn(['startdate']);
            $table->dropColumn(['enddate']);
            
            $table->date('date')->after('id');


        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('examdetails', function (Blueprint $table) {
        //     $table->dropForeign('examdetails_syllabus_id_foreign');
        //     $table->dropColumn(['syllabus_id']);
        // });

        
    }
}
