<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'customer_id');
    }
}
