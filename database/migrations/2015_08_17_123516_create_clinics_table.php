<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_ownerships', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        Schema::create('clinic_types', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        Schema::create('clinics', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->default('');
            $table->string('address', 100)->default('');
            $table->string('tel', 20)->default('');
            $table->string('service_hours', 20)->default('');
            $table->string('latitue', 20);
            $table->string('longitude', 20);
            $table->integer('ownership_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clinic_ownerships');
        Schema::drop('clinic_types');
        Schema::drop('clinics');
    }
}
