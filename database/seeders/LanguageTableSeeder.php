<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;


class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['language_id' => 'en','language_name' => 'english', 'display_name' => 'English', 'statusId' => 1],
            ['language_id' => 'hi','language_name' => 'hindi', 'display_name' => 'Hindi', 'statusId' => 1],
            ['language_id' => 'mr','language_name' => 'marathi', 'display_name' => 'Marathi', 'statusId' => 1],
        ];
        Language::insert($languages);
    }
}
