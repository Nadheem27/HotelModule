<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsAvailableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_available', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->text('room_number');
            $table->date('avail_date');
            $table->text('book_status');
            $table->text('booked_by')->nullable();
            $table->timestamp('booked_time')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_available');
    }
}
