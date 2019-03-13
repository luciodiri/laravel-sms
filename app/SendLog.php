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

        $query = "select 
                    SUM(log_success = 1) AS success,
                    SUM(log_success = 0) AS failure,
                    s.usr_id,
                    s.num_id,
                    n.cnt_id,
                    DATE(log_created) as log_date
                  FROM send_log s
                    JOIN numbers n ON s.num_id = n.num_id
                    JOIN countries cnt ON n.cnt_id = cnt.cnt_id
                  WHERE (log_created BETWEEN :date_from AND :date_to)
                  AND IF(:usr_id_cond = 0, 1=1, s.usr_id = :usr_id) 
                  AND IF(:cnt_id_cond = 0, 1=1, n.cnt_id = :cnt_id)
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
//
        return $logs;
    }

}