<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingTowns extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_towns', function($table)
        {
            $table->integer('sort_order')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_towns', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
