<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingTowns2 extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_towns', function($table)
        {
            $table->integer('contact_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_towns', function($table)
        {
            $table->dropColumn('contact_id');
        });
    }
}
