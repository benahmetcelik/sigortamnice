<?php

namespace App\Observers;

use App\Models\BlogComment;

class BlogCommentObserver
{
    /**
     * Handle the BlogComment "created" event.
     */
    public function creating(BlogComment $blogComment): void
    {
        $blogComment->created_by = request()->user();
        $blogComment->domain_id = domain()->id;
    }

    /**
     * Handle the BlogComment "updated" event.
     */
    public function updated(BlogComment $blogComment): void
    {
        //
    }

    /**
     * Handle the BlogComment "deleted" event.
     */
    public function deleted(BlogComment $blogComment): void
    {
        //
    }

    /**
     * Handle the BlogComment "restored" event.
     */
    public function restored(BlogComment $blogComment): void
    {
        //
    }

    /**
     * Handle the BlogComment "force deleted" event.
     */
    public function forceDeleted(BlogComment $blogComment): void
    {
        //
    }
}
