<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeVehiclesVehicleRepair extends Migration
{
    public function up()
    {
        Schema::create('acme_vehicles_vehicle_repair', function($table)
        {
            $table->engine = 'InnoDB';
            $table->smallInteger('vehicle_id');
            $table->smallInteger('repair_id');
            $table->primary(['vehicle_id','repair_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_vehicles_vehicle_repair');
    }
}
