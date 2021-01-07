<?php

    use Laravel\Lumen\Testing\DatabaseMigrations;

    class RoomAndBookingTest extends TestCase
    {
        use DatabaseMigrations;


        public function setUp(): void
        {
            parent::setUp();
            // seed the database
            $this->artisan('db:seed');
        }

        public function test_get_available_rooms()
        {

            $this->json('GET', '/get-available-rooms')
                ->seeJson([
                    'status' => 'ok',
                ]);
        }

        public function test_check_availability()
        {

            $this->json('POST', '/check-availability', ['room_number' => 19, 'start_date' => '2021/01/01', 'end_date' => '2021/01/09'])
                ->seeJson([
                    'status' => 'ok',
                ]);
        }

        public function test_get_categories()
        {

            $this->json('GET', '/get-categories')
                ->seeJson([
                    'status' => 'ok',
                ]);
        }


        public function test_make_booking()
        {

            $this->json('POST', '/make-booking', ['room_number' => 19, 'start_date' => '2021/01/01', 'end_date' => '2021/01/09'])
                ->seeJson([
                    'status' => 'ok',
                ]);
        }

    }
