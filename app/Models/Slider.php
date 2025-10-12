<?php

namespace App\Models;

use App\Traits\HasHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, HasHelper;

    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'button_link',
        'order',
        'status',
        'domain_id'
    ];

    private static mixed $tableHeaders = [
        'id' => 'ID',
        'title' => 'Başlık',
        'html_image' => 'Görsel',
        'html_status' => 'Durum',
        'actions' => 'İşlemler'
    ];

    private $inputs = [
        'title' => 'text',
        'description' => 'textarea',
        'image' => 'file',
        'button_text' => 'text',
        'button_link' => 'text',
        'order' => 'number',
        'status' => [
            0 => 'Pasif',
            1 => 'Aktif'
        ]
    ];

    protected $appends = [
        'html_image',
        'html_status'
    ];

    public function getHtmlImageAttribute()
    {
        return '<img src="' . asset($this->image) . '" alt="' . $this->title . '" class="img-thumbnail" width="100">';
    }

    public function getHtmlStatusAttribute()
    {
        return $this->status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>';
    }
}
