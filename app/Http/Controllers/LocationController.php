<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use Yajra\Datatables\Datatables;

class LocationController extends Controller
{
    public function index()
    {
        return view('location.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $tweets = Location::select(['id', 'name', 'latitude', 'longitude', 'query']);

        return Datatables::of($tweets)
            ->addColumn('actions', function ($location) {
                $buttons = '<a href="'.url('location').'/'.$location->id.'/edit" class="btn btn-xs btn-primary btn-datatable"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $buttons .= '<a href="'.url('location').'/'.$location->id.'/delete" class="btn btn-xs btn-danger btn-datatable" onclick="return confirm(\'Are your sure want to delete '.$location->name.'?\')"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
                return $buttons;
            })
            ->make(true);
    }

    public function create()
    {
        return view('location.edit');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if(isset($data['id'])){
            $location = Location::find($data['id']);
            $new = false;
        } else {
            $location = new Location();
            $new = true;
        }

        $location->name = $data['name'];
        $location->latitude = $data['latitude'];
        $location->longitude = $data['longitude'];
        $location->query = $data['query'];

        $location->save();

        if ($new) {
            Flash::success('Successfully added location '.$location->name.'.');
        } else {
            Flash::success('Successfully updated location '.$location->name.'.');
        }

        return view('location.index');
    }

    public function edit(Location $location)
    {
        return view('location.edit')->with(compact('location'));
    }

    public function destroy(Location $location)
    {
        $locationName = $location->name;

        $location->delete();

        Flash::success('Successfully delete '.$locationName.'.');

        return redirect(route('location'));
    }
}
