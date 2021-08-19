<?php namespace Acme\Setting\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeSettingMessage extends Migration
{
    public function up()
    {
        Schema::table('acme_setting_message', function($table)
        {
            $table->integer('sort_order')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('acme_setting_message', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
