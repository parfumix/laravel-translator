<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LanguagesTable extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->char('slug', 2)->unique();
            $table->string('title', 30);
            $table->tinyInteger('rank')->unsigned()->default(1);
            $table->boolean('active')->default(1);

            $table->index('active');
            $table->index('rank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('languages');
    }
}
