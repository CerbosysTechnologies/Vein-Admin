<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package_Test extends Model
{
    use HasFactory;

    protected $table = 'package_tests';

    protected $fillable = ['package_id','test_id'];


}
