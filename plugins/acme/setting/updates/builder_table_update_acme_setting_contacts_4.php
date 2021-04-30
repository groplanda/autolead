<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingContacts4 extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_contacts', function($table)
        {
            $table->string('map_cord')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_contacts', function($table)
        {
            $table->dropColumn('map_cord');
        });
    }
}
