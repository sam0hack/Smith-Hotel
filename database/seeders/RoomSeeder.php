<?php

    namespace Database\Seeders;

    use App\Models\Category;
    use App\Models\Room;
    use Faker\Factory as Faker;
    use Illuminate\Database\Seeder;

    class RoomSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $this->create();
        }

        protected function create()
        {

            for ($i = 1; $i <= 40; $i++) {
                $faker = Faker::create();
                $category = Category::get();
                $category = $category[rand(0, 1)];
                Room::firstOrCreate(['room_number' => $i], ['category_id' => $category->id, 'title' => $faker->colorName, 'number_of_beds' => rand(1, 4), 'cost' => rand(100, 9000), 'description' => $faker->realText()]);
            }

        }

    }
