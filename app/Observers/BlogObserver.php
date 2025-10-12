<?php

namespace App\Observers;

use App\Models\Blog;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     */
    public function creating(Blog $blog): void
    {
        $blog->created_by = request()->user();
        $blog->updated_by = request()->user();
        $blog->domain_id = domain()->id;
    }

    /**
     * Handle the Blog "updated" event.
     */
    public function updating(Blog $blog): void
    {
        $blog->updated_by = request()->user();
    }

    /**
     * Handle the Blog "deleted" event.
     */
    public function deleted(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "restored" event.
     */
    public function restored(Blog $blog): void
    {
        //
    }

    /**
     * Handle the Blog "force deleted" event.
     */
    public function forceDeleted(Blog $blog): void
    {
        //
    }
}
