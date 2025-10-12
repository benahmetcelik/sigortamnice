<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'status',
        'domain_id',
    ];

    /**
     * Get the customers for the dealer.
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * Get the domain that owns the dealer.
     */
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
