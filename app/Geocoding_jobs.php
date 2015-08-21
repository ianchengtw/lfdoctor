<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Geocoding_jobs extends Model
{
    const STATUS_INIT 			= 0;
    const STATUS_PROCESSING 	= 1;
    const STATUS_SUCCESS 		= 2;
    const STATUS_EMPTY_QUERY 	= 3;

    public static function SQL_generateJob()
    {
    	return "INSERT INTO geocoding_jobs (`clinic_id`, `status`)
				SELECT
					C.id AS clinic_id,
					0 AS status
				FROM
					clinics AS C LEFT JOIN
					geocoding_jobs AS jobs ON C.id = jobs.clinic_id
				WHERE jobs.id IS NULL";
    }
    public static function SQL_takeJob()
    {
    	return "SELECT
					jobs.id,
					jobs.clinic_id,
					C.name,
					C.address,
					jobs.status
				FROM
					geocoding_jobs AS jobs INNER JOIN
					clinics AS C ON jobs.clinic_id = C.id
				WHERE
					jobs.status = 0
				LIMIT 1";
    }
    public static function total_jobs()
    {
    	$sql = 'SELECT COUNT(1) AS TotalJobs FROM geocoding_jobs WHERE status = 0';
    	$result = DB::select(DB::raw($sql));

        if ($result)
        {
        	return intval($result[0]->TotalJobs);
        }
        else
        {
        	return 0;
        }
    }
    public static function markEmptyQuery($id)
    {
    	if ( $job = Geocoding_jobs::find( $id ) )
        {
            $job->status = Geocoding_jobs::STATUS_EMPTY_QUERY;
            $job->save();
            return TRUE;
        }
        else
        {
        	return FALSE;
        }
    }
}
