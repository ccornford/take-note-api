<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function boot() {}

    public function register() {
        $models = array(
            'Group',
            'Note'
        );

        foreach ($models as $model) {
            $this->app->bind(
                "App\\Repos\\Api\\V1\\{$model}\\{$model}RepositoryInterface",
                "App\\Repos\\Api\\V1\\{$model}\\Eloquent{$model}Repository"
            );
        }
    }
}