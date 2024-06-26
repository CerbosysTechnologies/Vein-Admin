<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function packages()
    {
        return $this->hasManyThrough(Package::class, CartItem::class);
    }
}
