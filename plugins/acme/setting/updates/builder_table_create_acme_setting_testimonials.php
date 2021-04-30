<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeSettingTestimonials extends Migration
{
    public function up()
    {
        Schema::create('acme_setting_testimonials', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->nullable()->default(0);
            $table->integer('time')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_setting_testimonials');
    }
}
