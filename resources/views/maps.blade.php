@extends('layouts.master')

@section('title', 'Maps')

@section('content')
<div id="map"></div>
@endsection

@push('scripts')
<script src="{{ url('assets/js/places.js') }}"></script>
<script>
    function initMap() {
        var yogyakarta = new google.maps.LatLng(-7.79, 110.375);

        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
            center: yogyakarta,
            zoom: 13
        });

        $.each(places, function(index, value) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(value.latitude, value.longitude),
                map: map,
                title: value.name
            });

            marker.addListener('click', function() {
                $.ajax({
                    url: "{{ url('maps/placeInfo?query=') }}" + value.query
                }).done(function(data) {
                    var contentString =
                            '<h5>' + value.name + '</h5>' +
                            '<div>There are ' + data.count + ' tweets about ' + value.name + '.</div>';

                    if (data.count > 0) {
                        contentString += '<div>Most recent tweets:</div>' +
                                '<table class="table table-hover">' +
                                '<thead><tr><th>Date Time</th><th>Tweet</th></tr></thead><tbody>';

                        $.each(data.recent_tweets, function (index, value) {
                            contentString += '<tr><td>' + value.date_time + '</td><td>' + value.raw_tweet + '</td>';
                        });

                        contentString += '</tbody>';
                    }

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    console.log(data);
                    infowindow.open(map, marker);
                });
            });
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqCYmeo01ZTavbm3vLcsGwtVTjYYF_Njg&callback=initMap" async defer></script>
@endpush