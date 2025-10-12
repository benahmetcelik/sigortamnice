<?php

namespace App\Modules\Blogs;

use App\Models\Blog;
use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class BlogsWithPaginateModule extends Module implements IModuleInterface
{
    public function getOutput()
    {
        $blogs = Blog::where('status', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return module_view('blogs.blogs_with_paginate', [
            'blogs' => $blogs
        ]);
    }

    public function load()
    {
        // Blog verilerini yükle
    }
}
