<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class Rooms extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('rooms', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('category_id');
                $table->integer('room_number');
                $table->double('cost');
                $table->integer('number_of_beds');
                $table->string('title');
                $table->string('description');
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
            Schema::dropIfExists('rooms');
        }
    }
