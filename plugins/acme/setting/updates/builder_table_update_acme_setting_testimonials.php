<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingTestimonials extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_testimonials', function($table)
        {
            $table->renameColumn('time', 'created_at');
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_testimonials', function($table)
        {
            $table->renameColumn('created_at', 'time');
        });
    }
}
