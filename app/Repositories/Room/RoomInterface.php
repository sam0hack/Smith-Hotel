<?php

    namespace App\Repositories\Room;

    interface RoomInterface
    {

        public function getCategories();

        public function checkAvailability($category_id, $start_date, $end_date = '', $room_id = '');

        public function bookRoom($array);
    }
