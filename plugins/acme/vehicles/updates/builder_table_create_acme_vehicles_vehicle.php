<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeVehiclesVehicle extends Migration
{
    public function up()
    {
        Schema::create('acme_vehicles_vehicle', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('brand')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->nullable()->default(0);
            $table->integer('user_id')->nullable();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('model')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_vehicles_vehicle');
    }
}
