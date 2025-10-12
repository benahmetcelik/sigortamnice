<?php

namespace App\Models;

use App\Traits\HasHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory,HasHelper;
    /**
     * @var mixed|string[]
     */
    private static mixed $tableHeaders = [
        'id'=>'ID',
        'title'=>'Başlık',
        'actions'=>'İşlemler'
    ];
    private $inputs = [
        'title' => 'text',
        'description' => 'textarea',
        'blog_id' => 'getBlogs',
    ];

    public $buttons = [
        'edit',
        'delete',
        'show'
    ];


    public function getComment()
    {
        return $this->hasMany(BlogComment::class,'id','comment_id');
    }

    public function getBlog()
    {
        return $this->hasMany(Blog::class,'id','blog_id');
    }
    public function getBlogs()
    {
        return Blog::query();
    }
}
