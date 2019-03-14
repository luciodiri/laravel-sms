<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SendLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'send_log';

    /**
     * @var string
     */
    protected $primaryKey = 'log_id';

    public $timestamps = false;


    /**
     * The main get logs method
     * Select the SMS success/failure count, based on filters
     *
     * @param $date_from
     * @param $date_to
     * @param int $cnt_id
     * @param int $usr_id
     * @return array
     */
    public function getDailySent($date_from, $date_to, $cnt_id = 0, $usr_id = 0)
    {
        $date_from .= ' 00:00:00';
        $date_to .= ' 23:59:59';

        /**
         * Query Performance Notes:
         * Date range done with indexed search, no DATE() usage
         * cnt_id sub-query: if country filter is selected:
         *  go to numbers table and find the cnt_id for that number.
         *  then compare the cnt_id to the search filer.
         * Use PKs and unique FK
         */
        $query = "select 
                    SUM(s.log_success = 1) AS success,
                    SUM(s.log_success = 0) AS failure,
                    s.usr_id,
                    DATE(log_created) as log_date
                  FROM send_log s
                  WHERE (log_created BETWEEN :date_from AND :date_to)
                  AND IF(:usr_id_cond = 0, 1=1, s.usr_id = :usr_id) 
                  AND IF(:cnt_id_cond = 0, 1=1, :cnt_id = (
                    SELECT cnt_id FROM numbers as n
                    WHERE s.num_id = n.num_id )
                  )
                  GROUP BY DAY(log_created)
                  ";

        // run the query with the placed parameters
        $logs = DB::select($query, [
            'date_from' => $date_from,
            'date_to' => $date_to,
            'usr_id_cond' => $usr_id,
            'usr_id' => $usr_id,
            'cnt_id_cond' =>  $cnt_id,
            'cnt_id' => $cnt_id
        ]);
//        exit(var_dump($logs));

        return $logs;
    }

}
