<?php

use DB;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('languages')->delete();

        Translator\DriverAssets\Database\Language::create(['title' => 'Română',  'slug' => 'ro', 'active' => true, 'rank' => 1]);
        Translator\DriverAssets\Database\Language::create(['title' => 'Русский', 'slug' => 'ru', 'active' => true, 'rank' => 2]);
        Translator\DriverAssets\Database\Language::create(['title' => 'English', 'slug' => 'en', 'active' => true, 'rank' => 3]);
    }
}
