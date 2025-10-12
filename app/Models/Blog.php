<?php

namespace App\Models;

use App\Traits\HasHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
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

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image_path',
        'status',
        'created_by',
        'updated_by',
        'category_id',
        'domain_id',
    ];

    private $inputs = [
        'title'=>'text',
        'slug'=>'text',
        'description'=>'textarea',
        'content'=>'textarea',
        'image_path'=>'file',
        'status'=>[
            0=>'Pasif',
            1=>'Aktif'
        ],
        'category_id'=>BlogCategory::class
    ];

    protected $appends = [
        'html_image',
        'html_status'
    ];

    public function getHtmlImageAttribute()
    {
        return '<img src="' . asset($this->image_path) . '" alt="' . $this->title . '" class="img-thumbnail" width="100">';
    }

    public function getHtmlStatusAttribute()
    {
        return $this->status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>';
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
