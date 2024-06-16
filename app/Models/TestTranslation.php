<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTranslation extends Model
{
    use HasFactory;

    protected $table = 'test_translation';
    protected $fillable = ['test_id', 'language_id', 'test_name','description'];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
