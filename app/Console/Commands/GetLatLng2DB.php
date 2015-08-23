<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Clinic_location;
use App\Geocoding_jobs;

class GetLatLng2DB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

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
        $flag = true;
        while($flag)
        {
            // Do job
            $this->fillGeoInfo();

            $sec        = $this->getRandom();
            $remainJobs = $this->remainJobs();
            $msg = sprintf('wait %d sec for next job. [ remain %d jobs ]', $sec, $remainJobs);
            echo $msg . PHP_EOL;

            if ($remainJobs == 0) break;

            sleep($sec);
        }
    }

    private function fillGeoInfo()
    {
        if ($this->remainJobs())
        {
            if ($location = $this->takeJob())
            {
                $status = Geocoding_jobs::STATUS_INIT;

                if ($geo = $this->geocoding($location->address))
                {
                    $this->info( sprintf('%s => (%s, %s)',
                                        $location->address,
                                        $geo['lat'],
                                        $geo['lng'] ) );

                    $l = Clinic_location::where('id', '=', $location->id)->first();
                    $l->lat = $geo['lat'];
                    $l->lng = $geo['lng'];
                    $l->save();

                    $status = Geocoding_jobs::STATUS_SUCCESS;
                }
                else
                {
                    $status = Geocoding_jobs::STATUS_EMPTY_QUERY;
                }

                $j = new Geocoding_jobs;
                $j->location_id = $location->id;
                $j->status      = $status;
                $j->save();

                return TRUE;
            }
        }

        return FALSE;
    }
    private function remainJobs()
    {
        $sql = "SELECT COUNT(1) AS remainJobs
                FROM clinic_locations AS L
                LEFT JOIN geocoding_jobs AS J ON L.id = J.location_id
                WHERE lat = 0
                    AND J.id IS NULL";
        return DB::select(DB::raw($sql))[0]->remainJobs;
    }
    private function takeJob()
    {
        $sql = "SELECT
                    L.id
                    ,L.address
                    ,L.lat
                    ,L.lng
                FROM clinic_locations AS L
                LEFT JOIN geocoding_jobs AS J ON L.id = J.location_id
                WHERE lat = 0
                    AND L.address LIKE '臺北%'
                    AND J.id IS NULL
                LIMIT 1";
        $r = DB::select(DB::raw($sql));
        if ($r)
        {
            return $r[0];
        }
        else
        {
            return NULL;
        }
    }

    private function geocoding($string)
    {
        // $string = "新北市新店區北新路二段164號1樓";
        $string = str_replace (" ", "+", urlencode($string));
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        try {
            if ($response['status'] != 'OK')
            {
                var_dump($response);
                return NULL;
            }

            return [
                'lat' => $response['results'][0]['geometry']['viewport']['northeast']['lat'],
                'lng' => $response['results'][0]['geometry']['viewport']['northeast']['lng']
            ];
        } catch (Exception $e) {
            return NULL;
        }
    }
    private function getRandom()
    {
        return rand(1, rand(2, 3));
    }
}
