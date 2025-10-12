<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Observers\BlogCategoryObserver;
use App\Observers\BlogCommentObserver;
use App\Observers\BlogObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blog::observe(BlogObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
        BlogComment::observe(BlogCommentObserver::class);
    }
}
