<?php

namespace App\Providers;

use \App\Faker\CrochetImageProvider as CrochetImageProvider;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class CrochetImageFaker extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            $faker = FakerFactory::create();

            $faker->addProvider(new CrochetImageProvider($faker));

            return $faker;

        });

        $this->app->singleton(Eloquentfactory::class, function ($app) {
            return Eloquentfactory::construct(
                $app->make(FakerGenerator::class), $this->app->databasePath('factories')
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
