<?php

    namespace App\Providers;

    use App\Repositories\Room\RoomInterface;
    use App\Repositories\Room\RoomRepository;
    use Illuminate\Support\ServiceProvider;

    class RepositoryServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         *
         * @return void
         */
        public function register()
        {
            //
        }

        public function boot()
        {
            $this->app->bind(RoomInterface::class, RoomRepository::class);
        }
    }
