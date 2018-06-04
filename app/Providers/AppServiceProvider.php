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
use Illuminate\Support\Facades\DB;

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

        $userSessions = \DB::table('user_sessions')
            ->select('browser_family', \DB::raw('count(*) as total'))
            ->groupBy('browser_family')
            ->get();

        view()->share('sessions', $userSessions);
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
