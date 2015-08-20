<?php

use Illuminate\Database\Seeder;

class ClinicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->clinics_ownerships();
    	$this->clinics_types();
    }
    private function clinics_ownerships()
    {
        DB::table('clinic_ownerships')->delete();
        $data = [
        	['name' => '私立中醫診所'],
        	['name' => '醫療財團法人診所'],
        	['name' => '醫療社團法人診所'],
        	['name' => '私立牙醫診所'],
        	['name' => '私立西醫診所'],
        	['name' => '宗教社團法人附設診所/醫務室'],
        	['name' => '榮民診所(榮家醫務室)'],
        	['name' => '軍方診所(民眾診療附設門診部)'],
        	['name' => '縣市立診所'],
        	['name' => '部立及直轄市立診所'],
        ];
        DB::table('clinic_ownerships')->insert($data);
    }
    private function clinics_types()
    {
        DB::table('clinic_types')->delete();
        $data = [
        	['name' => '中醫一般診所'],
        	['name' => '中醫診所'],
        	['name' => '西醫診所'],
        	['name' => '牙醫診所'],
        	['name' => '中醫專科診所'],
        	['name' => '牙醫一般診所'],
        	['name' => '牙醫專科診所'],
        	['name' => '西醫醫務室'],
        	['name' => '西醫專科診所'],
        ];
        DB::table('clinic_types')->insert($data);
    }
}
