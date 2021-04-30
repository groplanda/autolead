<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingContacts extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_contacts', function($table)
        {
            $table->integer('town_id');
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_contacts', function($table)
        {
            $table->dropColumn('town_id');
        });
    }
}
