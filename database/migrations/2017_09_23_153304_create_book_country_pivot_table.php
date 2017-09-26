<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookCountryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_country', function (Blueprint $table) {
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('country_id');
            $table->timestamps();

            $table->unique(['book_id', 'country_id']);

            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('cascade');

            $table->foreign('country_id')
                ->references('id')->on('countries')
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
        Schema::dropIfExists('book_country');
    }
}
