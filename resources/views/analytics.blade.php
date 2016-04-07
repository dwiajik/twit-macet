@extends('layouts.master')

@section('title', 'Analytics')

@section('content')
<div class="container">
    <h2>Analytics</h2>
    <br>
    <h4>Tweets per Day</h4>
    <div>
        <input type="checkbox" id="checkbox-nb" checked> Naive Bayes
    </div>
    <div>
        <input type="checkbox" id="checkbox-svm" checked> Support Vector Machine
    </div>
    <div>
        <input type="checkbox" id="checkbox-dt" checked> Decision Tree
    </div>
    <table class="table table-bordered" id="tweets">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">Time</th>
            <th colspan="14" class="text-center">Day</th>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Sunday</th>
            <th colspan="2" class="text-center">Monday</th>
            <th colspan="2" class="text-center">Tuesday</th>
            <th colspan="2" class="text-center">Wednesday</th>
            <th colspan="2" class="text-center">Thursday</th>
            <th colspan="2" class="text-center">Friday</th>
            <th colspan="2" class="text-center">Saturday</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <th rowspan="3" class="text-center row-time">00.00 - 05.59</th>
            @foreach($tweetCount["00"]['naive_bayes'] as $row)
                <td class="row-nb">
                    <strong>NB</strong>
                </td>
                <td class="row-nb">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["00"]['svm'] as $row)
                <td class="row-svm">
                    <strong>SVM</strong>
                </td>
                <td class="row-svm">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["00"]['decision_tree'] as $row)
                <td class="row-dt">
                    <strong>DT</strong>
                </td>
                <td class="row-dt">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>

        <tr>
            <th rowspan="3" class="text-center row-time">06.00 - 11.59</th>
            @foreach($tweetCount["06"]['naive_bayes'] as $row)
                <td class="row-nb">
                    <strong>NB</strong>
                </td>
                <td class="row-nb">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["06"]['svm'] as $row)
                <td class="row-svm">
                    <strong>SVM</strong>
                </td>
                <td class="row-svm">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["06"]['decision_tree'] as $row)
                <td class="row-dt">
                    <strong>DT</strong>
                </td>
                <td class="row-dt">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>

        <tr>
            <th rowspan="3" class="text-center row-time">12.00 - 17.59</th>
            @foreach($tweetCount["12"]['naive_bayes'] as $row)
                <td class="row-nb">
                    <strong>NB</strong>
                </td>
                <td class="row-nb">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["12"]['svm'] as $row)
                <td class="row-svm">
                    <strong>SVM</strong>
                </td>
                <td class="row-svm">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["12"]['decision_tree'] as $row)
                <td class="row-dt">
                    <strong>DT</strong>
                </td>
                <td class="row-dt">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>

        <tr>
            <th rowspan="3" class="text-center row-time">18.00 - 23.59</th>
            @foreach($tweetCount["18"]['naive_bayes'] as $row)
                <td class="row-nb">
                    <strong>NB</strong>
                </td>
                <td class="row-nb">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["18"]['svm'] as $row)
                <td class="row-svm">
                    <strong>SVM</strong>
                </td>
                <td class="row-svm">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        <tr>
            @foreach($tweetCount["18"]['decision_tree'] as $row)
                <td class="row-dt">
                    <strong>DT</strong>
                </td>
                <td class="row-dt">
                    {{ $row }} tweets
                </td>
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $('#checkbox-nb').change(function() {
        if(this.checked) {
            $('.row-nb').show();
        } else {
            $('.row-nb').hide();
        }
    });
    $('#checkbox-svm').change(function() {
        if(this.checked) {
            $('.row-svm').show();
        } else {
            $('.row-svm').hide();
        }
    });
    $('#checkbox-dt').change(function() {
        if(this.checked) {
            $('.row-dt').show();
        } else {
            $('.row-dt').hide();
        }
    });
</script>
@endpush