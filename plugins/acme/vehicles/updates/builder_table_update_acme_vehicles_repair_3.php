<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAcmeVehiclesRepair3 extends Migration
{
    public function up()
    {
        Schema::table('acme_vehicles_repair', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
    
    public function down()
    {
        Schema::table('acme_vehicles_repair', function($table)
        {
            $table->integer('user_id')->nullable();
        });
    }
}
