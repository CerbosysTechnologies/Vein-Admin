<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;
    protected $table = 'laboratory_locations';
    protected $fillable = ['name', 'address', 'contact_person_name','contact','facility_type'];

}
