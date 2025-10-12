<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Traits\HasCrud;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    use HasCrud;
    protected $model = BlogComment::class;
    protected $routeBase = 'admin.blogcomment.';
    protected $viewBase = 'backend.blog.';
}
