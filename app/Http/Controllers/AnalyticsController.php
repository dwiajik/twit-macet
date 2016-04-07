<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\TweetSummary;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnalyticsController extends Controller
{
    public function index()
    {
        $this->recalculateSummary();
        return view('analytics', ['tweetCount' => $this->getTweetsCount()]);
    }

    private function getTweetsCount()
    {
        foreach (array("00", "06", "12", "18") as $hour) {
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
                    $tweets[$hour][$classifier][$day] = TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first()
                        ->tweets_count;
                }
            }
        }

//        foreach (array("00", "06", "12", "18") as $time) {
//            foreach (array("naive_bayes",
//                         "svm",
//                         "decision_tree") as $classifier) {
//                foreach (array("Sunday",
//                             "Monday",
//                             "Tuesday",
//                             "Wednesday",
//                             "Thursday",
//                             "Friday",
//                             "Saturday") as $day) {
//                    $tweets[$time][$classifier][$day] = Tweet::whereRaw('TIME(date_time) >= "' . str_pad($time, 2, '0', STR_PAD_LEFT) . ':00:00"')
//                        ->whereRaw('TIME(date_time) < "' . str_pad($time + 6, 2, '0', STR_PAD_LEFT) . ':00:00"')
//                        ->whereRaw('DAYNAME(date_time) = "' . $day . '"')
//                        ->where($classifier, 'traffic')
//                        ->count();
//                }
//            }
//        }

        return $tweets;
    }

    private function recalculateSummary()
    {
        $checkpoint = Cache::get('checkpoint_datetime', "2016-01-01 00:00:00");

        foreach (array("00", "06", "12", "18") as $hour) {
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
                    $summary = TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first();

                    if ($summary == null) {
                        $summary = new TweetSummary();
                        $summary->day = $day;
                        $summary->hour = $hour;
                        $summary->classifier = $classifier;
                    }

                    $today = date("Y-m-d H:i:s", strtotime("today"));
                    Cache::forever('checkpoint_datetime', $today);

                    $tweets_count = Tweet::whereRaw('TIME(date_time) >= "' . str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00"')
                        ->whereRaw('TIME(date_time) < "' . str_pad($hour + 6, 2, '0', STR_PAD_LEFT) . ':00:00"')
                        ->whereRaw('DAYNAME(date_time) = "' . $day . '"')
                        ->where($classifier, 'traffic')
                        ->where('date_time', '>', $checkpoint)
                        ->where('date_time', '<=', $today)
                        ->count();

                    $days_count = Tweet::whereRaw('TIME(date_time) >= "' . str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00"')
                        ->whereRaw('TIME(date_time) < "' . str_pad($hour + 6, 2, '0', STR_PAD_LEFT) . ':00:00"')
                        ->whereRaw('DAYNAME(date_time) = "' . $day . '"')
                        ->where($classifier, 'traffic')
                        ->where('date_time', '>', $checkpoint)
                        ->where('date_time', '<=', $today)
                        ->groupBy('date_time')
                        ->count();

                    $summary->tweets_count = $summary->tweets_count + $tweets_count;
                    $summary->days_count = $summary->days_count + $days_count;
                    $summary->save();

                    Log::info($summary);
                }
            }
        }

        return true;
    }
}
