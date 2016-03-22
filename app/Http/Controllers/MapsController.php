<?php

namespace App\Http\Controllers;


use App\Tweet;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index()
    {
        return view('maps');
    }

    public function getPlaceInfo(Request $request)
    {
        $place = $request->input('query');

        $response['count'] = Tweet::where(
                function ($query) {
                    $query->where('naive_bayes', 'traffic')
                        ->orWhere('svm', 'traffic')
                        ->orWhere('decision_tree', 'traffic');
                })
            ->where(
                function ($query) use ($place) {
                    $query->where('raw_tweet', 'like', "%$place%")
                        ->orWhere('raw_tweet', 'like', "%$place%");
                })
            ->whereRaw('date_time >= CURRENT_DATE')
            ->whereRaw('date_time < CURRENT_DATE + INTERVAL 1 DAY')
            ->count();

        $response['recent_tweets'] = Tweet::select(['date_time', 'raw_tweet'])
            ->where(
                function ($query) {
                    $query->where('naive_bayes', 'traffic')
                        ->orWhere('svm', 'traffic')
                        ->orWhere('decision_tree', 'traffic');
                })
            ->where(
                function ($query) use ($place) {
                    $query->where('raw_tweet', 'like', "%$place%")
                        ->orWhere('raw_tweet', 'like', "%$place%");
                })
            ->orderBy('date_time', 'desc')
            ->take(3)
            ->get();

        return response()->json($response);
    }

    public function getTweetsCount()
    {

    }
}