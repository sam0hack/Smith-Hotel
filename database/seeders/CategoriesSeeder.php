<?php

    namespace Database\Seeders;

    use App\Models\Category;
    use Illuminate\Database\Seeder;

    class CategoriesSeeder extends Seeder
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
            $types = array('simple', 'premium');

            foreach ($types as $type) {
                Category::firstOrCreate(['title' => $type]);
            }

        }
    }
