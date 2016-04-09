@extends('layouts.master')

@section('title', 'Analytics')

@section('content')
<div class="container">
    <h2>Analytics</h2>
    <div id="time-column-chart" class="chart"></div>

    <div id="day-column-chart" class="chart"></div>

    <div id="line-chart" class="chart"></div>
</div>
@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
    $.ajax({
        url: "{{ url('analytics/api/v1/timeColumnChart') }}"
    }).done(function(data) {
        console.log(data);
        $(function () {
            $('#time-column-chart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Tweets Count by Hour'
                },
                xAxis: {
                    categories: [
                        '00.00 - 05.59',
                        '06.00 - 11.59',
                        '12.00 - 17.59',
                        '18.00 - 23.59'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'tweets / day'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} tweets/day</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                series: [{
                    name: 'Naive Bayes',
                    data: data.naive_bayes

                }, {
                    name: 'Support Vector Machine',
                    data: data.svm

                }, {
                    name: 'Decision Tree',
                    data: data.decision_tree
                }]
            });
        });
    });
</script>

<script>
    $.ajax({
        url: "{{ url('analytics/api/v1/dayColumnChart') }}"
    }).done(function(data) {
        $(function () {
            $('#day-column-chart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Tweets Count by Day'
                },
                xAxis: {
                    categories: [
                        'Sunday',
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                        'Saturday'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'tweets / day'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} tweets/day</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                series: [{
                    name: 'Naive Bayes',
                    data: data.naive_bayes

                }, {
                    name: 'Support Vector Machine',
                    data: data.svm

                }, {
                    name: 'Decision Tree',
                    data: data.decision_tree
                }]
            });
        });
    });
</script>

<script>
    $.ajax({
        url: "{{ url('analytics/api/v1/lineChart') }}"
    }).done(function(data) {
        console.log(data);
        $(function () {
            $('#line-chart').highcharts({
                title: {
                    text: 'Tweets Trend (last 7 days)'
                },
                xAxis: {
                    categories: ['7 days ago', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', '1 days ago', 'today']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'tweets / day'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ' tweets/day'
                },
                series: [{
                    name: 'Naive Bayes',
                    data: data.naive_bayes
                }, {
                    name: 'Support Vector Machine',
                    data: data.svm
                }, {
                    name: 'Decision Tree',
                    data: data.decision_tree
                }]
            });
        });
    });
</script>
@endpush