<?php

namespace App\Models;

use App\Traits\HasHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory, HasHelper;

    /**
     * @var mixed|string[]
     */
    private static mixed $tableHeaders = [
        'id' => 'ID',
        'title' => 'Başlık',
        'html_image' => 'Resim',
        'html_status' => 'Durum',
        'actions' => 'İşlemler'
    ];
    private $inputs = [
        'title' => 'text',
        'slug' => 'text',
        'description' => 'textarea',
        'image_path' => 'file',
        'status' => [
            0 => 'Kapalı',
            1 => 'Açık'
        ],
        'category_id' => 'getCategories'
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
        'status',
        'created_by',
        'updated_by',
        'category_id',
        'domain_id'
    ];

    public $buttons = [
        'edit',
        'delete',
        'show'
    ];

    protected $appends = [
        'html_image',
        'html_status'
    ];

    public function getCategories()
    {
        return $this;
    }
}
