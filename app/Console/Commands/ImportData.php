<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use DB;
use App\Clinic;
use App\Clinic_division;
use App\Clinic_location;
use App\Clinic_ownership;
use App\Clinic_punishment;
use App\Clinic_service_hour;
use App\Clinic_type;
use App\Clinics_link_divisions;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import clinics data';

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
        // $this->importClinics();
        $this->importClinicSchedules();
        // $this->importClinicPunishments();
        // $this->generateRelationalTableData();
    }

    private function generateRelationalTableData()
    {
        $contents = Storage::get('clinics.txt');
        $contents = explode(PHP_EOL, $contents);
        $totalSize = count($contents);
        $count = 0;
        $ownerships = [];
        $types = [];
        $divisions = [];
        foreach ($contents as $key => $value)
        {
            if ($count == 0) {$count++;continue;}
            // $value = iconv("big5","UTF-8//IGNORE",$value);
            $value = explode('::', $value);
            if (count($value) != 6) continue;

            if (!isset($ownerships[ $value[1] ])) { $ownerships[$value[1]] = $value[1]; }
            if (!isset($types[ $value[2] ])) { $types[$value[2]] = $value[2]; }

            $ds = explode(',', $value[5]);
            foreach ($ds as $d) {
                if (!isset($divisions[ $d ])) { $divisions[$d] = $d; }
            }

            $count++;
        }
        
        $path = 'database/seeds/';
        $this->dumpData($path . 'ownerships.seed', $ownerships);
        $this->dumpData($path . 'types.seed', $types);
        $this->dumpData($path . 'divisions.seed', $divisions);
    }
    private function dumpData($filename, $in)
    {
        $data = '';
        foreach ($in as $v) {
            $data .= sprintf("['name' => '%s'],", $v) . PHP_EOL;
        }
        file_put_contents($filename, $data);
    }
    private function importClinics()
    {
        $contents = Storage::get('clinics.txt');
        $contents = explode(PHP_EOL, $contents);
        $totalSize = count($contents);
        $count = 0;
        foreach ($contents as $key => $value)
        {
            if ($count == 0) {$count++;continue;}
            // $value = iconv("big5","UTF-8//IGNORE",$value);
            $value = explode('::', $value);
            
            if (count($value) == 6)
            {
                $id = $this->insertClinic($value);
                $this->generateDivision($id, $value[5]);
            }

            $count++;
            var_dump(sprintf('%d/%d', $count, $totalSize));
        }
    }
    private function insertClinic(array $data)
    {
        if (Clinic::where('name', '=', $data[0])->exists())
        {
            return Clinic::where('name', '=', $data[0])->first()->id;
        }
        else
        {
            $c = new Clinic;
            $c->name           = $data[0];
            $c->tel            = $data[3];
            $c->location_id    = $this->insertLocation($data[4]);
            // $c->service_hour_id             = $data[3];
            $c->ownership_id   = $this->insertOwnership($data[1]);
            $c->type_id        = $this->insertType($data[2]);
            // $c->division_id    = $this->insertDivision($data[5]);
            $c->save();
            return $c->id;
        }
    }
    private function insertLocation($address)
    {
        if (Clinic_location::where('address', '=', $address)->exists())
        {
            return Clinic_location::where('address', '=', $address)->first()->id;
        }
        else
        {
            $c = new Clinic_location;
            $c->address = $address;
            $c->save();
            return $c->id;
        }
    }
    private function insertOwnership($name)
    {
        if (Clinic_ownership::where('name', '=', $name)->exists())
        {
            return Clinic_ownership::where('name', '=', $name)->first()->id;
        }
        else
        {
            return 0;
        }
    }
    private function insertType($name)
    {
        if (Clinic_type::where('name', '=', $name)->exists())
        {
            return Clinic_type::where('name', '=', $name)->first()->id;
        }
        else
        {
            return 0;
        }
    }
    private function insertDivision($name)
    {
        if (Clinic_division::where('name', '=', $name)->exists())
        {
            return Clinic_division::where('name', '=', $name)->first()->id;
        }
        else
        {
            return 0;
        }
    }
    private function generateDivision($clinic_id, $divisions)
    {
        $divisions = explode(',', $divisions);
        foreach ($divisions as $division) {
            
            if (Clinic_division::where('name', '=', $division)->exists())
            {
                $division_id = Clinic_division::where('name', '=', $division)->first()->id;
                if (DB::table('clinics_link_divisions')
                        ->where('clinic_id', '=', $clinic_id)
                        ->where('division_id', '=', $division_id)
                        ->exists() )
                {
                    continue;
                }

                $l = new Clinics_link_divisions;
                $l->clinic_id   = $clinic_id;
                $l->division_id = $division_id;
                $l->save();
            }

        }
    }

    private function importClinicSchedules()
    {
        $contents = Storage::get('clinics_schedule.txt');
        $contents = explode(PHP_EOL, $contents);
        $totalSize = count($contents);
        $count = 0;
        foreach ($contents as $key => $value)
        {
            if ($count == 0) {$count++;continue;}
            // $value = iconv("big5","UTF-8//IGNORE",$value);
            $value = explode('::', $value);
            
            if (count($value) == 4)
            {
                if (Clinic::where('name', '=', $value[0])->exists())
                {
                    $clinic_id = Clinic::where('name', '=', $value[0])->first()->id;
                    
                    $c = new Clinic_service_hour;
                    $c->clinic_id = $clinic_id;
                    $c->time_start = $value[1];
                    $c->time_end = $value[2];
                    $c->work_day = ($value[3] == 'TRUE') ? TRUE : FALSE;
                    $c->save();
                }

            }

            $count++;
            var_dump(sprintf('%d/%d', $count, $totalSize));
        }
    }
    private function importClinicPunishments()
    {
        $contents = Storage::get('clinics_punishment.txt');
        $contents = explode(PHP_EOL, $contents);
        $totalSize = count($contents);
        var_dump($totalSize);
        $count = 0;
        foreach ($contents as $key => $value)
        {
            // $value = iconv("big5","UTF-8//IGNORE",$value);
            // $value = explode(',', $value);
            var_dump($value);

            $count++;
            // if ($count > 3) {break;}
        }
    }
    
}
