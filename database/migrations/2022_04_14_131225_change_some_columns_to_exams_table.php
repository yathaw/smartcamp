<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnsToExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->unsignedInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches');
            // $table->date('date')->after('id');

            // $table->foreignId('section_id')
            //         ->after('rule')
            //         ->references('id')
            //         ->on('sections')
            //         ->onDelete('cascade');
            
        });

        // Schema::table('examdetails', function (Blueprint $table) {
            

        //     $table->date('enddate')->after('id');
        //     $table->date('startdate')->after('id');

        //     $table->foreignId('curriculum_id')
        //             ->after('endtime')
        //             ->references('id')
        //             ->on('curricula')
        //             ->onDelete('cascade');
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign('exams_batch_id_foreign');
            $table->dropColumn(['batch_id']);
        });

        Schema::table('examdetails', function (Blueprint $table) {
            
        });
    }
}
