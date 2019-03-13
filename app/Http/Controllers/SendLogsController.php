<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use App\SendLog;

class SendLogsController extends Controller
{

    public function home() {

        list($users, $countries) = $this->populateFilters();

        return view('send_log')->with([
            'users' => $users,
            'countries' => $countries
        ]);
    }

    public function search() {

        $searched = array(
            'date_from' => request('date_from'),
            'date_to'   => request('date_to'),
            'user'      => request('user'),
            'country'   => request('country')
        );

        $sendLogs = new SendLog();

        $results = $sendLogs->getDailySent(
            $searched['date_from'], $searched['date_to'], $searched['country'], $searched['user']
        );

        list($users, $countries) = $this->populateFilters();

        return view('send_log')->with([
             'results' => $results,
             'search' => $searched,
             'users' => $users,
             'countries' => $countries
         ]);
    }

    /**
     * @return array
     */
    public function populateFilters():array
    {
        $users = User::all();
        $countries = Country::all();
        return array($users, $countries);
    }
}
