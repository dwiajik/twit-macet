<?php

namespace App\Http\Controllers;


use App\Tweet;
use Illuminate\Http\Request;
use Log;
use Yajra\Datatables\Datatables;

class TweetsController extends Controller
{
    public function index(Request $request)
    {
        return view('tweets')->with('query', $request->input('query'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $tweets = Tweet::where(function ($query) {
            $query->where('naive_bayes', 'traffic')
                ->orWhere('svm', 'traffic')
                ->orWhere('decision_tree', 'traffic');
        });

        $search = $request->input('search');
        if($search['value']) {
            // filter the query
            $tweets = $tweets->where('raw_tweet', 'like', '%'.$search['value'].'%');
        }

        return Datatables::of($tweets)->make(true);
    }
}