<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lending_id');
            $table->unsignedBigInteger('borrowed_id');
            $table->string('title');
            $table->unsignedBigInteger('money');
            $table->date('lending_on');
            $table->date('due_on')->nullable();
            $table->date('returned_on')->nullable();
            $table->timestamps();

            $table->foreign('lending_id')->references('id')->on('users');
            $table->foreign('borrowed_id')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
