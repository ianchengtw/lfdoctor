<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App\Clinic;
use App\Clinic_types;
use App\Clinic_ownerships;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $this->importClinicDataFromCSV();
        $this->importClinicDataFromCSV2();
    }
    private function Clinic_types()
    {
        $table = [];
        foreach (Clinic_types::all() as $type) {
            $table[$type->name] = $type->id;
        }
        return $table;
    }
    private function Clinic_ownerships()
    {
        $table = [];
        foreach (Clinic_ownerships::all() as $ownership) {
            $table[$ownership->name] = $ownership->id;
        }
        return $table;
    }
    private function importClinicDataFromCSV2()
    {
        $types      = $this->Clinic_types();
        $ownerships = $this->Clinic_ownerships();

        $contents = Storage::get('clinics_v2.csv');
        $contents = explode(PHP_EOL, $contents);
        $totalSize = count($contents);
        $count = 0;
        foreach ($contents as $key => $value)
        {
            if ($count == 0) {$count++; continue;}
            $value = iconv("big5","UTF-8//IGNORE",$value);
            $value = explode(',', $value);

            if (count($value) >= 3)
            {
                    var_dump(ord($value[5]));
                    exit();
                $data = Clinic::where('name', '=', $value[0])->first();
                if ($data == null)
                {
                    // 機構名稱,權屬別,型態別,電話,地址,看診時間
                    $clinic = new Clinic;
                    $clinic->name           = $value[0];
                    $clinic->address        = $value[4];
                    $clinic->tel            = $value[3];
                    $clinic->service_hours  = (ord($value[5]) == 13) ? null : $value[5];
                    $clinic->ownership_id   = isset($ownerships[$value[1]]) ? $ownerships[$value[1]] : 0;
                    $clinic->type_id        = isset($types[$value[2]]) ? $types[$value[2]] : 0;
                    $clinic->save();
                }
            }

            $count++;
            $this->info(sprintf("Updated %s/%s", $count, $totalSize));
        }
    }
    private function importClinicDataFromCSV()
    {
        $contents = Storage::get('clinics.csv');
        $contents = explode(PHP_EOL, $contents);
        $totalSize = count($contents);
        $count = 0;
        foreach ($contents as $key => $value)
        {
            if ($count == 0) {$count++; continue;}
            $value = iconv("big5","UTF-8//IGNORE",$value);
            if ($value)
            {
                $value = explode(',', $value);
                if (count($value) >= 3)
                {
                    $data = Clinic::where('name', '=', $value[0])->first();
                    if ($data == null)
                    {
                        $clinic = new Clinic;
                        $clinic->name       = $value[0];
                        $clinic->address    = $value[2];
                        $clinic->tel        = $value[1];
                        $clinic->save();
                    }
                }
            }
            $count++;
            $this->info(sprintf("Updated %s/%s", $count, $totalSize));
        }
    }
}
