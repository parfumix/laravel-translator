<?php

namespace Translator\DriverAssets\Database;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    protected $table = 'translations';

    public $timestamps = false;

    protected $fillable = ['language_id', 'key', 'value'];

}