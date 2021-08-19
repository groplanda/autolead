<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeVehiclesRepair extends Migration
{
    public function up()
    {
        Schema::table('acme_vehicles_repair', function($table)
        {
            $table->integer('sort_order')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('acme_vehicles_repair', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
