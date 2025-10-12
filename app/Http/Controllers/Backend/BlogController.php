<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\HasCrud;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use HasCrud;

    protected $model = Blog::class;
    protected $routeBase = 'admin.blog.';
    protected $viewBase = 'backend.blog.';
}
