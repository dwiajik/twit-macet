<?php

namespace App\Http\Controllers;

use App\Tweet;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        return view('analytics', ['tweetCount' => $this->getTweetsCount()]);
    }

    public function getTweetsCount()
    {
//        $tweets = Tweet::whereRaw('TIME(date_time) >= "12:00:00"')
//            ->whereRaw('TIME(date_time) < "24:00:00"')
//            // This throws away the timestamp portion of the date
//            ->whereRaw('DAYNAME(date_time) = "Sunday"')
//            // And restrict these results to only those created in the last week
//            ->where(function ($query) {
//                $query->where('naive_bayes', 'traffic')
//                    ->orWhere('svm', 'traffic')
//                    ->orWhere('decision_tree', 'traffic');
//            })
//            ->count();

        foreach (array(0, 6, 12,18) as $time) {
            foreach (array("naive_bayes",
                         "svm",
                         "decision_tree") as $classifier) {
                foreach (array("Sunday",
                             "Monday",
                             "Tuesday",
                             "Wednesday",
                             "Thursday",
                             "Friday",
                             "Saturday") as $day) {
                    $tweets[$time][$classifier][$day] = Tweet::whereRaw('TIME(date_time) >= "' . str_pad($time, 2, '0', STR_PAD_LEFT) . ':00:00"')
                        ->whereRaw('TIME(date_time) < "' . str_pad($time + 6, 2, '0', STR_PAD_LEFT) . ':00:00"')
                        ->whereRaw('DAYNAME(date_time) = "' . $day . '"')
                        ->where($classifier, 'traffic')
                        ->count();
                }
            }
        }

        return $tweets;
    }
}
