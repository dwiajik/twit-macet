@extends('layouts.master')

@section('title', 'Tweets')

@section('content')
    <div class="container">
        <h2>Traffic Tweets</h2>
        <table class="table table-bordered" id="tweets">
            <thead>
            <tr>
                <th>Tweet Time</th>
                <th>Tweet</th>
                <th>Naive Bayes</th>
                <th>SVM</th>
                <th>Decision Tree</th>
                <th>Detected Locations</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('#tweets').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('tweets.datatable') !!}',
            columns: [
                { data: 'date_time', name: 'date_time' },
                { data: 'raw_tweet', name: 'raw_tweet'},
                { data: 'naive_bayes', name: 'naive_bayes' },
                { data: 'svm', name: 'svm' },
                { data: 'decision_tree', name: 'decision_tree' },
                { data: 'detected_locations', name: 'detected_locations' }
            ],
            "order": [[ 0, "desc" ]]
        });
    });
</script>
@endpush