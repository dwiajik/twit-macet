<?php

namespace App\Http\Controllers;


use App\Location;
use App\Tweet;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $locations = Location::all();

        return view('map')->with('locations', $locations);
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
            ->where('date_time', '>=', date("Y-m-d H:i:s", strtotime("today")))
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
}