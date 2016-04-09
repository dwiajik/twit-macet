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

        return view('analytics');
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

                    $tweet_count = TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first()
                        ->tweets_count;

                    $day_count = TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first()
                        ->days_count;

                    $tweets[$hour][$classifier][$day] = $day_count == 0? 0: round($tweet_count/$day_count, 2);
                }
            }
        }

        return $tweets;
    }

    public function timeColumnChartAPI()
    {
        foreach (array("naive_bayes",
                     "svm",
                     "decision_tree") as $classifier) {
            $response[$classifier] = [];
            foreach (array("00", "06", "12", "18") as $hour) {
                $tweets_count = 0;
                $days_count = 0;
                foreach (array("Sunday",
                             "Monday",
                             "Tuesday",
                             "Wednesday",
                             "Thursday",
                             "Friday",
                             "Saturday") as $day) {

                    $tweets_count += TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first()
                        ->tweets_count;

                    $days_count += TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first()
                        ->days_count;
                }
                $response[$classifier][] = $days_count == 0? 0: round($tweets_count/$days_count, 2);
            }
        }

        return response()->json($response);
    }

    public function dayColumnChartAPI()
    {
        foreach (array("naive_bayes",
                     "svm",
                     "decision_tree") as $classifier) {
            $response[$classifier] = [];
            foreach (array("Sunday",
                         "Monday",
                         "Tuesday",
                         "Wednesday",
                         "Thursday",
                         "Friday",
                         "Saturday") as $day) {
                $tweets_count = 0;
                $days_count = 0;
                foreach (array("00", "06", "12", "18") as $hour) {

                    $tweets_count += TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first()
                        ->tweets_count;

                    $days_count += TweetSummary::where('day', $day)
                        ->where('hour', $hour)
                        ->where('classifier', $classifier)
                        ->first()
                        ->days_count;
                }
                $response[$classifier][] = $days_count == 0? 0: round($tweets_count/$days_count, 2);
            }
        }

        return response()->json($response);
    }

    public function lineChartAPI()
    {
        foreach (array("naive_bayes",
                     "svm",
                     "decision_tree") as $classifier) {

            $response[$classifier] = [];

            for($i = 7; $i > 0; $i--) {
                $date_limit_after = date("Y-m-d", strtotime("-" . $i - 1 . " day")) . " 00:00:00";
                $date_limit_before = date("Y-m-d", strtotime("-" . $i . " day")) . " 00:00:00";

                $response[$classifier][] = Tweet::where($classifier, 'traffic')
                    ->where('date_time', '>=', $date_limit_after)
                    ->where('date_time', '<', $date_limit_before)
                    ->count();
            }

            $response[$classifier][] = Tweet::where($classifier, 'traffic')
                ->where('date_time', '>=', date("Y-m-d H:i:s", strtotime("today")))
                ->count();
        }

        return response()->json($response);
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
                }
            }
        }

        return true;
    }
}
