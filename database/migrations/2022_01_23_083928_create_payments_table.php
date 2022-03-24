<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('voucherno');
            $table->string('amount');
            $table->text('photo');
            $table->date('date');

            $table->foreignId('package_id')
                    ->references('id')
                    ->on('packages')
                    ->onDelete('cascade');

            $table->foreignId('student_id')
                    ->references('id')
                    ->on('students')
                    ->onDelete('cascade');

            $table->foreignId('staff_id')
                    ->references('id')
                    ->on('staff')
                    ->onDelete('cascade');

            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');

            $table->foreignId('section_id')
                    ->references('id')
                    ->on('sections')
                    ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
