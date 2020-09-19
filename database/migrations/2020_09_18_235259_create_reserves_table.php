<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('theater_id');
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedInteger('ticket_count');
            $table->unsignedBigInteger('ticket1_id');
            $table->unsignedBigInteger('ticket2_id')->nullable();
            $table->unsignedBigInteger('ticket3_id')->nullable();
            $table->unsignedBigInteger('ticket4_id')->nullable();
            $table->unsignedBigInteger('ticket5_id')->nullable();
            $table->unsignedInteger('total_price');;
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('theater_id')->references('id')->on('theaters')->onDelete('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->foreign('ticket1_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('ticket2_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('ticket3_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('ticket4_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('ticket5_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
}
