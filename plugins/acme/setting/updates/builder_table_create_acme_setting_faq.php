<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeSettingFaq extends Migration
{
    public function up()
    {
        Schema::create('acme_setting_faq', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('question')->nullable();
            $table->text('answer')->nullable();
            $table->integer('sort_order')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_setting_faq');
    }
}
