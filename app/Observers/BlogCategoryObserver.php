<?php

namespace App\Observers;

use App\Models\BlogCategory;

class BlogCategoryObserver
{
    /**
     * Handle the BlogCategory "created" event.
     */
    public function creating(BlogCategory $blogCategory): void
    {
        $blogCategory->created_by = request()->user();
        $blogCategory->updated_by = request()->user();
        $blogCategory->domain_id = domain()->id;
    }

    /**
     * Handle the BlogCategory "updated" event.
     */
    public function updating(BlogCategory $blogCategory): void
    {
        $blogCategory->updated_by = request()->user();
    }

    /**
     * Handle the BlogCategory "deleted" event.
     */
    public function deleted(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "restored" event.
     */
    public function restored(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "force deleted" event.
     */
    public function forceDeleted(BlogCategory $blogCategory): void
    {
        //
    }
}
