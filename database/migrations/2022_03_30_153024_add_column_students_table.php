<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // $table->date('registerdate')->nullable()->after('id');

            // $table->string('nativename')->nullable()->change();
            // $table->dropColumn('file');

            // $table->text('gbc')->nullable()->after('lunchbox');
            // $table->text('idf')->nullable()->after('lunchbox');
            // $table->text('idb')->nullable()->after('lunchbox');
            // $table->text('pcm')->nullable()->after('lunchbox');
            // $table->text('tc')->nullable()->after('lunchbox');
            // $table->text('lmir')->nullable()->after('lunchbox');

            // $table->string('dormitory')->nullable()->after('lunchbox');
            // $table->text('otherinterest')->nullable()->after('bio');
            // $table->text('academicawards')->nullable()->after('bio');
            // $table->string('psn')->nullable()->after('id');
            // $table->string('medicalproblem')->nullable()->after('id');
            // $table->string('medicalneeds')->nullable()->after('lunchbox');
            // $table->string('medicalallergy')->nullable()->after('lunchbox');
            // $table->string('foodallergy')->nullable()->after('lunchbox');
            // $table->string('otherallergy')->nullable()->after('lunchbox');

            // $table->foreignId('grade_id')
            //         ->after('religion_id')
            //         ->references('id')
            //         ->on('grades')
            //         ->onDelete('cascade');

            // $table->foreignId('sport_id')
            //         ->after('blood_id')
            //         ->references('id')
            //         ->on('sports')
            //         ->onDelete('cascade');

        });

        // Schema::table('guardians', function (Blueprint $table) {
        //     $table->string('workemail')->nullable()->after('id');

        // });

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
