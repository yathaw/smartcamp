<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCurriculumTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('curriculum_teacher', function (Blueprint $table) {
            $table->dropForeign('curriculum_teacher_curriculum_id_foreign');
            $table->dropForeign('curriculum_teacher_teacher_id_foreign');

            $table->dropColumn(['curriculum_id']);
            $table->dropColumn(['teacher_id']);

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
