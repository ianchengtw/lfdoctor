<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Geocoding_jobs;

class CreateGeocodingJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geocoding_jobs', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('clinic_id')->unsigned();
            $table->integer('status')->unsigned()->default(Geocoding_jobs::STATUS_INIT);
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
        Schema::drop('geocoding_jobs');
    }
}
