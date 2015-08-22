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
        $this->clinics_divisions();
    }
    private function clinics_ownerships()
    {
        DB::table('clinic_ownerships')->delete();
        $data = [
            ['name' => '私立中醫診所'],
            ['name' => '私立西醫診所'],
            ['name' => '私立牙醫診所'],
            ['name' => '榮民診所(榮家醫務室)'],
            ['name' => '醫療財團法人診所'],
            ['name' => '縣市立診所'],
            ['name' => '軍方診所(民眾診療附設門診部)'],
            ['name' => '醫療社團法人診所'],
            ['name' => '部立及直轄市立診所'],
            ['name' => '宗教社團法人附設診所/醫務室'],
        ];
        DB::table('clinic_ownerships')->insert($data);
    }
    private function clinics_types()
    {
        DB::table('clinic_types')->delete();
        $data = [
            ['name' => '中醫一般診所'],
            ['name' => '西醫診所'],
            ['name' => '西醫專科診所'],
            ['name' => '牙醫一般診所'],
            ['name' => '西醫醫務室'],
            ['name' => '牙醫診所'],
            ['name' => '中醫診所'],
            ['name' => '牙醫專科診所'],
            ['name' => '中醫專科診所'],
        ];
        DB::table('clinic_types')->insert($data);
    }
    private function clinics_divisions()
    {
        DB::table('clinic_divisions')->delete();
        $data = [
            ['name' => '中醫'],
            ['name' => '西醫'],
            ['name' => '家庭醫學科'],
            ['name' => '內科'],
            ['name' => '牙科'],
            ['name' => '急診醫學科'],
            ['name' => '兒科'],
            ['name' => '神經科'],
            ['name' => '耳鼻喉科'],
            ['name' => '眼科'],
            ['name' => '皮膚科'],
            ['name' => '婦產科'],
            ['name' => '外科'],
            ['name' => '精神科'],
            ['name' => '復健科'],
            ['name' => '整形外科'],
            ['name' => '骨科'],
            ['name' => '神經外科'],
            ['name' => '泌尿科'],
            ['name' => '放射診斷科'],
            ['name' => '齒顎矯正科'],
            ['name' => '麻醉科'],
            ['name' => '傷科'],
            ['name' => '針灸科'],
            ['name' => '口腔顎面外科'],
            ['name' => '痔科'],
            ['name' => '婦科'],
            ['name' => '解剖病理科'],
            ['name' => '臨床病理科'],
            ['name' => '核子醫學科'],
            ['name' => '身心科'],
        ];
        DB::table('clinic_divisions')->insert($data);
    }
}
