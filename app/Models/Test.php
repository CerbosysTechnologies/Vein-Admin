<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;


class Test extends Model
{
    use HasFactory;

    public function packages()
    {
        return $this->belongsToMany(PackageTranslation::class, 'package__tests');
    }
    
    public function translations()
    {
        return $this->hasMany(TestTranslation::class);
    }
}
