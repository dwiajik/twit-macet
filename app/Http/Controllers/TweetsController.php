<?php

namespace App\Http\Controllers;


use App\Tweet;
use Yajra\Datatables\Datatables;

class TweetsController extends Controller
{
    public function index()
    {
        return view('tweets');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        $tweets = Tweet::where('naive_bayes', 'traffic')
            ->orWhere('svm', 'traffic')
            ->orWhere('decision_tree', 'traffic')
            ->orderBy('date_time', 'desc');

        return Datatables::of($tweets)->make(true);
    }
}