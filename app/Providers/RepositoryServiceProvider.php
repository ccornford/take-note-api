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
                "App\\Api\\V1\\Repos\\{$model}\\{$model}RepositoryInterface",
                "App\\Api\\V1\\Repos\\{$model}\\Eloquent{$model}Repository"
            );
        }
    }
}