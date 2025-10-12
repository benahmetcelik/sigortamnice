<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\HasCrud;

class BlogCategoryController extends Controller
{
    use HasCrud;

    protected $model = BlogCategory::class;
    protected $routeBase = 'admin.blogcategory.';
    protected $viewBase = 'backend.blog.';

}
