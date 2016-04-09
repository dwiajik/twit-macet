@extends('layouts.master')

@section('title', 'Analytics')

@section('content')
<div class="container">
    <h2>Analytics</h2>
    <div id="time-column-chart" class="chart"></div>

    <div id="day-column-chart" class="chart"></div>

    <div id="daily-line-chart" class="chart"></div>

    <div id="weekly-line-chart" class="chart"></div>

    <div id="monthly-line-chart" class="chart"></div>
</div>
@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
    $.ajax({
        url: "{{ url('analytic/api/v1/timeColumnChart') }}"
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
        url: "{{ url('analytic/api/v1/dayColumnChart') }}"
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
                        'Saturday',
                        "<strong>Average</strong>"
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
        url: "{{ url('analytic/api/v1/dailyLineChart') }}"
    }).done(function(data) {
        console.log(data);
        $(function () {
            $('#daily-line-chart').highcharts({
                title: {
                    text: 'Daily Tweets Trend'
                },
                xAxis: {
                    categories: ['7 days ago', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', '1 day ago', 'today']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'tweets'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ' tweets'
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
        url: "{{ url('analytic/api/v1/weeklyLineChart') }}"
    }).done(function(data) {
        console.log(data);
        $(function () {
            $('#weekly-line-chart').highcharts({
                title: {
                    text: 'Weekly Tweets Trend'
                },
                xAxis: {
                    categories: ['7 weeks ago', '6 weeks ago', '5 weeks ago', '4 weeks ago', '3 weeks ago', '2 weeks ago', '1 week ago', 'this week']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'tweets'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ' tweets'
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
        url: "{{ url('analytic/api/v1/monthlyLineChart') }}"
    }).done(function(data) {
        console.log(data);
        $(function () {
            $('#monthly-line-chart').highcharts({
                title: {
                    text: 'Monthly Tweets Trend'
                },
                xAxis: {
                    categories: ['7 months ago', '6 months ago', '5 months ago', '4 months ago', '3 months ago', '2 months ago', '1 month ago', 'this month']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'tweets'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ' tweets'
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