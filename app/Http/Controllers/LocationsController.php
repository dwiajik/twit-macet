<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Datatables;

class LocationsController extends Controller
{
    public function index()
    {
        return view('locations');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $tweets = Location::select(['id', 'name', 'latitude', 'longitude', 'query']);
;

        return Datatables::of($tweets)
            ->addColumn('actions', function ($locations) {
                $buttons = '<a href="#edit-'.$locations->id.'" class="btn btn-xs btn-primary btn-datatable"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $buttons .= '<a href="#delete-'.$locations->id.'" class="btn btn-xs btn-danger btn-datatable"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
                return $buttons;
            })
            ->make(true);
    }
}
