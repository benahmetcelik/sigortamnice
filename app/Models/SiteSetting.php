<?php

namespace App\Models;

use App\Scopes\FilterByDomain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'config_key',
        'config_value',
        'domain_id',
        'config_type'
    ];


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // using seperate scope class
        static::addGlobalScope(new FilterByDomain);

    }

}
