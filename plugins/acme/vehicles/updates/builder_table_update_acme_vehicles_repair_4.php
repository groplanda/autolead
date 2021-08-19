<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeVehiclesRepair4 extends Migration
{
    public function up()
    {
        Schema::table('acme_vehicles_repair', function($table)
        {
            $table->integer('vehicle_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_vehicles_repair', function($table)
        {
            $table->dropColumn('vehicle_id');
        });
    }
}
