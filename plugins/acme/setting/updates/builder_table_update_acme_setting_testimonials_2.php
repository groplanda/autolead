<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingTestimonials2 extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_testimonials', function($table)
        {
            $table->boolean('status')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_testimonials', function($table)
        {
            $table->dropColumn('status');
        });
    }
}
