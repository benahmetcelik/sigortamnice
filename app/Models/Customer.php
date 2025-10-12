<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dealer_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'status',
        'tc_no'
    ];

    /**
     * Get the dealer that owns the customer.
     */
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }
}
