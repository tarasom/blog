<?php

namespace App\Providers;

use App\Entities\Category;
use App\Entities\Post;
use app\Observers\CategoryObserver;
use app\Observers\PostObserver;
use App\Services\Contracts\PostImageService as PostImageServiceInterface;
use App\Services\PostImageService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'post'     => Post::class,
            'category' => Category::class,
        ]);

        Post::observe(PostObserver::class);
        Category::observe(CategoryObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostImageServiceInterface::class, PostImageService::class);

    }
}
