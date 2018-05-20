<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\CommentRepositoryEloquent;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\CommentRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\PostRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(CommentRepository::class, CommentRepositoryEloquent::class);
    }
}
