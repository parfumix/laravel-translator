<?php

namespace Translator\DriverAssets\Database;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    protected $table = 'languages';

    public static $rules = [
        'name' => 'required',
        'slug' => 'required|unique:languages'
    ];

    protected $fillable = ['name', 'slug', 'locale', 'active'];

    /**
     * Retrieve only active languages
     *
     * @param $query
     */
    public function scopeActive($query) {
        $query->where('active', '=', 1);
    }

    /**
     * Order languages in desired order
     *
     * @param $query
     */
    public function scopeRanked($query) {
        $query->orderBy('rank', 'ASC');
    }
}