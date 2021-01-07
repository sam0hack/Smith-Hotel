<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class UsersSeeder extends Seeder
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

            User::firstOrcreate(['email' => 'sam.nyx@live.com'], ['name' => 'sam', 'password' => Hash::make('pass1234')]);

        }
    }
