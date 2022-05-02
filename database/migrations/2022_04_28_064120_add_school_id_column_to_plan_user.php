<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolIdColumnToPlanUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_user', function (Blueprint $table) {
            $table->foreignId('school_id')
                    ->after('user_id')
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
        Schema::table('plan_user', function (Blueprint $table) {
            //
        });
    }
}
