@extends('layouts.master')

@section('title', 'Locations')

@section('content')
    <div class="container">
        <h2>Locations</h2>
        <table class="table table-bordered" id="locations">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Query</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        var datatable = $('#locations').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('locations.datatable') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'latitude', name: 'latitude'},
                { data: 'longitude', name: 'longitude' },
                { data: 'query', name: 'query' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush