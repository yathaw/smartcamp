<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('invoiceno');
            $table->string('admitted');
            $table->year('ay');
            $table->string('pc');
            $table->year('pcy');
            $table->string('ppc');
            $table->string('acyear1');
            $table->string('dc');
            $table->string('acyear2');
            $table->text('desscription');
            $table->date('lastattendance');
            $table->date('approvedate');


            $table->foreignId('student_id')
                    ->references('id')
                    ->on('students')
                    ->onDelete('cascade');

            $table->foreignId('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');

            $table->foreignId('staff_id')
                    ->references('id')
                    ->on('staff')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('transfers');
    }
}
