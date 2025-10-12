<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SystemConfig extends Model
{
    use HasFactory;
    protected $fillable = ['config_key', 'config_value', 'config_type'];

    /**
     * @return Carbon|mixed
     */
    protected function getConverted()
    {
        if($this->config_value){
            return match ($this->config_type) {
                'datetime' => Carbon::parse($this->config_value),
                'int' => intval($this->config_value),
                default => $this->config_value,
            };
        }
        return null;
    }
}
