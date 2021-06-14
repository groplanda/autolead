<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeSettingVideos extends Migration
{
    public function up()
    {
        Schema::create('acme_setting_videos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('orientation')->nullable();
            $table->text('video')->nullable();
            $table->integer('sort_order')->nullable();
            $table->boolean('status')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_setting_videos');
    }
}
