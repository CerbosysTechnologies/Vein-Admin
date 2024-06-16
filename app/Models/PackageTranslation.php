<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    use HasFactory;

    protected $table = 'package_translation';


    protected $fillable = ['package_id', 'language_id', 'package_name', 'description'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
