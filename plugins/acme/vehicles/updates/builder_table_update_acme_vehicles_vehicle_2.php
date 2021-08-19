<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeVehiclesVehicle2 extends Migration
{
    public function up()
    {
        Schema::table('acme_vehicles_vehicle', function($table)
        {
            $table->string('vin')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_vehicles_vehicle', function($table)
        {
            $table->dropColumn('vin');
        });
    }
}
