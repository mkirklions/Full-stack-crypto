<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  if(!Schema::hasTable('user_infos')){
        //remember that this doesnt create the defaults ->nullable() 
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('nickname');
            $table->text('first_name');
            $table->text('last_name' );
            $table->text('street_address') ;
            $table->text('email') ;
            $table->text('city') ;
            $table->integer('postal_code') ;
            $table->integer('associated_number') ;
            $table->string('phone_number') ;
            $table->timestamps();
        });
    }
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
