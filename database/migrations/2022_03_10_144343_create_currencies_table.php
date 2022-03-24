<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('symbol')->nullable();
            $table->foreignId('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->text('flag')->after('phonecode')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currencies', function (Blueprint $table) {
            //
        });
    }
}
