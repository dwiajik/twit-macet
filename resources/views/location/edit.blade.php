@extends('layouts.master')

@if(!isset($location->id))
    @section('title', 'Add Location')
@else
    @section('title', 'Edit Location')
@endif

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@if(!isset($location->id)){{ 'Add' }}@else{{ 'Edit' }}@endif Location</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/location') }}">
                            {!! csrf_field() !!}

                            @if(isset($location->id))<input type="hidden" name="id" value="{{ $location->id }}">@endif

                            <div class="form-group">
                                <label class="col-md-4 control-label">Location Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" @if(isset($location->name)) value="{{ $location->name }}"@endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Latitude</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="latitude" step=any @if(isset($location->latitude)) value="{{ $location->latitude }}"@endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Longitude</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="longitude" step=any @if(isset($location->longitude)) value="{{ $location->longitude }}"@endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Query</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="query" @if(isset($location->query)) value="{{ $location->query }}"@endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>@if(!isset($location->id)){{ 'Create' }}@else{{ 'Update' }}@endif Location
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection