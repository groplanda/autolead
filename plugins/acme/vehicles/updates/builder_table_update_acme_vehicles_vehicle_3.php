<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeVehiclesVehicle3 extends Migration
{
    public function up()
    {
        Schema::table('acme_vehicles_vehicle', function($table)
        {
            $table->smallInteger('user_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('acme_vehicles_vehicle', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
