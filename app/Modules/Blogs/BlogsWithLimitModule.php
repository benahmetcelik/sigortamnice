<?php

namespace App\Modules\Blogs;

use App\Models\Blog;
use App\Modules\BaseModule\IModuleInterface;
use App\Modules\BaseModule\Module;

class BlogsWithLimitModule extends Module implements IModuleInterface
{
    public function getOutput()
    {
        $blogs = Blog::where('status', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return module_view('blogs.blogs_with_limit', [
            'blogs' => $blogs
        ]);
    }

    public function load()
    {
        // Blog verilerini yükle
    }
}
