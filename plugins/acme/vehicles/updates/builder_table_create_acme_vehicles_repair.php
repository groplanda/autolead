<?php namespace Acme\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAcmeVehiclesRepair extends Migration
{
    public function up()
    {
        Schema::create('acme_vehicles_repair', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->string('price')->nullable();
            $table->string('mileage')->nullable();
            $table->text('spare_parts')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acme_vehicles_repair');
    }
}
