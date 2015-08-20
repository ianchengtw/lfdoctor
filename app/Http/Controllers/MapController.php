<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class MapController extends Controller
{
    public function getItemsInCircle($id)
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
}
