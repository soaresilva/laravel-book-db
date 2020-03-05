<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // up method will change the state 
    {
        Schema::create('reviews', function (Blueprint $table) {
            // create  table name  //      // it will make the things into table


            //these are colummns that the tble will have
            $table->bigIncrements('id'); // shortcut for primay key, Auto increments
            $table->string('review'); // now it is making a column for reviews
            $table->string('name'); // a new column in reviews 
            $table->timestamps(); // created creeated_at and updated_at

            //if we modify migrations then we have to get it back and 
            //php artisan migrate:rollback which will call the drop function
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
