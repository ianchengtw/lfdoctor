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
        $this->clinics();
        $this->clinic_locations();
        $this->clinic_service_hours();
        $this->clinic_ownerships();
        $this->clinic_types();
        $this->clinic_divisions();
        $this->clinics_link_divisions();
        $this->clinics_with_lat_lng();
        $this->clinic_punishments();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clinics');
        Schema::drop('clinic_locations');
        Schema::drop('clinic_service_hours');
        Schema::drop('clinic_ownerships');
        Schema::drop('clinic_types');
        Schema::drop('clinic_divisions');
        Schema::drop('clinics_link_divisions');
        Schema::drop('clinics_with_lat_lng');
        Schema::drop('clinic_punishments');
    }

    private function clinics()
    {
        Schema::create('clinics', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->unique();
            $table->string('tel', 50)->default('');
            $table->integer('location_id')->unsigned();
            $table->integer('service_hour_id')->unsigned();
            $table->integer('ownership_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    private function clinic_locations()
    {
        Schema::create('clinic_locations', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('address', 200)->default('');
            $table->decimal('lat', 18, 12);
            $table->decimal('lng', 18, 12);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    private function clinic_service_hours()
    {
        Schema::create('clinic_service_hours', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('clinic_id')->unsigned();
            $table->string('time_start', 5);
            $table->string('time_end', 5);
            $table->boolean('work_day');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    private function clinic_ownerships()
    {
        Schema::create('clinic_ownerships', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    private function clinic_types()
    {
        Schema::create('clinic_types', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    private function clinic_divisions()
    {
        Schema::create('clinic_divisions', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    private function clinics_link_divisions()
    {
        Schema::create('clinics_link_divisions', function(Blueprint $table) {
            $table->integer('clinic_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    private function clinics_with_lat_lng()
    {
        Schema::create('clinics_with_lat_lng', function(Blueprint $table) {
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
    private function clinic_punishments()
    {
        Schema::create('clinic_punishments', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('clinic_id')->unsigned();
            $table->string('city', 50)->default('');
            $table->string('people', 50)->default('');
            $table->text('punishment');
            $table->text('reason');
            $table->date('date_start');
            $table->date('date_end');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
}
