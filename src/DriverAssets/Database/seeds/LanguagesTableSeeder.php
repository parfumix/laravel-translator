<?php

use DB;
use Illuminate\Database\Seeder;
use Translator\DriverAssets\Database\Language;

class LanguagesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('languages')->delete();

        $languages = config('laravel-locale.locales');

        array_walk($languages, function($slug, $options) {
            Language::create([
                'title'  => $options['title'],
                'slug'   => $slug,
                'active' => true,
                'rank'   => 1
            ]);
        });
    }
}
