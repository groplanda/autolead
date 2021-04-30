<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingGallery extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_gallery', function($table)
        {
            $table->text('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_gallery', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
