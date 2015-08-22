<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class MapController extends Controller
{
    public function getItemById($id)
    {

        $sql = "SELECT
                    C.id,
                    C.name,
                    C.address,
                    C.tel,
                    C.service_hours,
                    C.latitue,
                    C.longitude,
                    O.name AS ownership,
                    T.name AS type
                FROM 
                    clinics AS C JOIN 
                    clinic_ownerships AS O ON C.ownership_id = O.id JOIN
                    clinic_types AS T ON C.type_id = T.id
                WHERE C.id = {$id};";

        $item = DB::select(DB::raw($sql));
        return response()->json($item);
    }
    public function getItemByName($name)
    {
        $sql = "SELECT
                    C.id,
                    C.name,
                    C.address,
                    C.tel,
                    C.service_hours,
                    C.latitue,
                    C.longitude,
                    O.name AS ownership,
                    T.name AS type
                FROM 
                    clinics AS C JOIN 
                    clinic_ownerships AS O ON C.ownership_id = O.id JOIN
                    clinic_types AS T ON C.type_id = T.id
                WHERE C.name LIKE '%{$name}%';";

        $item = DB::select(DB::raw($sql));
        return response()->json($item);
    }
    public function getItemByLatLng($lat, $lng)
    {
        $sql = "SELECT
                    C.id,
                    C.name,
                    C.address,
                    C.tel,
                    C.service_hours,
                    C.latitue,
                    C.longitude,
                    O.name AS ownership,
                    T.name AS type
                FROM 
                    clinics AS C JOIN 
                    clinic_ownerships AS O ON C.ownership_id = O.id JOIN
                    clinic_types AS T ON C.type_id = T.id
                WHERE
                    C.latitue = '{$lat}' AND
                    C.longitude = '{$lng}';";

        $item = DB::select(DB::raw($sql));
        return response()->json($item);
    }
    public function getItemsInCircle($lat, $lng, $radius = 10)
    {
        $sql = "SELECT
                    C.id
                    ,C.name
                    ,C.tel
                    ,GROUP_CONCAT(  CONCAT( CONCAT( CONCAT( CONCAT( SH.time_start, ',') , SH.time_end ), ',' ), SH.work_day) SEPARATOR '::') AS service_time
                    ,L.address
                    ,L.lat
                    ,L.lng
                    ,( 6371 * acos( cos( radians({$lat}) ) * cos( radians( L.lat ) ) * cos( radians( L.lng ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin(radians(L.lat)) ) ) AS distance
                FROM clinics AS C
                INNER JOIN clinic_locations AS L ON C.location_id = L.id
                INNER JOIN clinic_service_hours AS SH ON C.id = SH.clinic_id
                WHERE L.lat != 0
                GROUP BY
                    C.id
                    ,C.name
                    ,C.tel
                    ,L.address
                    ,L.lat
                    ,L.lng
                HAVING distance <= {$radius}
                ORDER BY distance;";

        $items = DB::select(DB::raw($sql));
        return response()->json($this->parseServiceTime($items));
    }
    // public function getItemsInCircle($lat, $lng, $radius = 10)
    // {
    //     $sql = "SELECT
    //                 C.id,
    //                 C.name,
    //                 C.address,
    //                 C.tel,
    //                 C.service_hours,
    //                 C.latitue,
    //                 C.longitude,
    //                 O.name AS ownership,
    //                 T.name AS type,
    //                 ( 6371 * acos( cos( radians({$lat}) ) * cos( radians( latitue ) ) * cos( radians( longitude ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin(radians(latitue)) ) ) AS distance
    //             FROM 
    //                 clinics AS C JOIN 
    //                 clinic_ownerships AS O ON C.ownership_id = O.id JOIN
    //                 clinic_types AS T ON C.type_id = T.id
    //             HAVING distance < $radius 
    //             ORDER BY distance ;";

    //     $item = DB::select(DB::raw($sql));
    //     return response()->json($item);
    // }
    public function getItemsInCircleByTT($lat, $lng, $type, $time, $radius = 10)
    {
        $sql = "SELECT
                    C.id
                    ,C.name
                    ,C.tel
                    ,GROUP_CONCAT(  CONCAT( CONCAT( CONCAT( CONCAT( SH.time_start, ',') , SH.time_end ), ',' ),  SH.work_day)
                    SEPARATOR '::') AS service_time
                    ,L.address
                    ,L.lat
                    ,L.lng
                    ,( 6371 * acos( cos( radians({$lat}) ) * cos( radians( L.lat ) ) * cos( radians( L.lng ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin(radians(L.lat)) ) ) AS distance
                FROM clinics AS C
                INNER JOIN clinic_locations AS L ON C.location_id = L.id
                INNER JOIN clinic_service_hours AS SH ON C.id = SH.clinic_id
                WHERE
                    L.lat != 0
                    AND (   
                            (
                                BINARY SH.time_start <= BINARY SH.time_end
                                AND (
                                    BINARY '{$time}' >= BINARY SH.time_start AND BINARY '{$time}' <= BINARY SH.time_end
                                )
                            )
                            OR (
                                BINARY SH.time_start > BINARY SH.time_end
                                AND (
                                    BINARY '{$time}' >= BINARY SH.time_start AND BINARY '{$time}' <= BINARY SH.time_end
                                )
                            )
                    )
                GROUP BY
                    C.id
                    ,C.name
                    ,C.tel
                    ,L.address
                    ,L.lat
                    ,L.lng
                HAVING distance <= {$radius}
                ORDER BY distance;";

        // echo $sql;exit();
        $items = DB::select(DB::raw($sql));
        return response()->json($this->parseServiceTime($items));
    }
    private function parseServiceTime($data)
    {
        foreach($data as &$item)
        {
            $temp = [];
            $a = explode('::', $item->service_time);
            foreach($a as $v)
            {
                $b = explode(',', $v);
                $temp[] = [
                    'time_start' => $b[0],
                    'time_end' => $b[1],
                    'work_day' => $b[2],
                ];
            }
            $item->service_time = $temp;
        }
        return $data;
    }
}
