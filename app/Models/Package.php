<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;

class Package extends Model
{
    use HasFactory;

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'package_tests', 'package_id', 'test_id');
    }
    public function translations()
    {
        return $this->hasMany(PackageTranslation::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
