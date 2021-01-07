<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class Bookings extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('room_id');
                $table->bigInteger('user_id')->nullable()->comment('This could be null for guests');
                $table->date('start_date');
                $table->date('end_date');
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
            Schema::dropIfExists('bookings');
        }
    }
