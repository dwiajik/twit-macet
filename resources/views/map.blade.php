@extends('layouts.master')

@section('title', 'Maps')

@section('content')
<div id="map"></div>
<div id="legend" class="legend">
    <strong>Legend</strong><br><br>
    <img src="https://maps.google.com/mapfiles/ms/icons/red-dot.png" height="24px"> There are tweets posted today<br><br>
    <img src="https://maps.google.com/mapfiles/ms/icons/orange-dot.png" height="24px"> No tweet posted today
</div>
@endsection

@push('scripts')
{{--<script src="{{ url('assets/js/places.js') }}"></script>--}}
<script>
    var places = [
        @foreach($locations as $location)
            {
                name: '{{ $location->name }}',
                latitude: {{ $location->latitude }},
                longitude: {{ $location->longitude }},
                query: '{{ $location->query }}'
            },
        @endforeach
        ];
</script>
<script>
    function initMap() {
        var yogyakarta = new google.maps.LatLng(-7.79, 110.375);

        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
            center: yogyakarta,
            zoom: 13
        });

        $.each(places, function(index, value) {
            var self = this;
            self.marker = new google.maps.Marker({
                position: new google.maps.LatLng(value.latitude, value.longitude),
                map: map,
                title: value.name,
                icon: 'https://maps.google.com/mapfiles/ms/icons/orange-dot.png'
            });

            $.ajax({
                url: "{{ url('map/placeInfo?query=') }}" + value.query
            }).done(function(data) {
                if (data.count > 0) {
                    self.marker.setIcon('https://maps.google.com/mapfiles/ms/icons/red-dot.png');
                } else {
                    self.marker.setIcon('https://maps.google.com/mapfiles/ms/icons/orange-dot.png');
                }
            });

            self.marker.addListener('click', function() {
                $.ajax({
                    url: "{{ url('map/placeInfo?query=') }}" + value.query
                }).done(function(data) {
                    var contentString =
                            '<h5>' + value.name + '</h5>' +
                            '<div>There are <strong>' + data.count + ' tweets posted today</strong> about <strong>' + value.name + '.</strong></div><br>';

                    if (data.recent_tweets.length > 0) {
                        contentString += '<div>Most recent tweets:</div>' +
                                '<table class="table table-hover">' +
                                '<thead><tr><th>Date Time</th><th>Tweet</th></tr></thead><tbody>';

                        $.each(data.recent_tweets, function (index, value) {
                            contentString += '<tr><td>' + value.date_time + '</td><td>' + value.raw_tweet + '</td>';
                        });

                        contentString += '</tbody></table>';
                    }

                    if (data.count > 0) {
                        self.marker.setIcon('https://maps.google.com/mapfiles/ms/icons/red-dot.png');
                    } else {
                        self.marker.setIcon('https://maps.google.com/mapfiles/ms/icons/orange-dot.png');
                    }

                    contentString += '<a href="{{ url('tweet?query=') }}' + value.query + '">See all tweets</a>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    infowindow.open(map, self.marker);
                });
            });
        });

        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(
                document.getElementById('legend'));
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqCYmeo01ZTavbm3vLcsGwtVTjYYF_Njg&callback=initMap" async defer></script>
@endpush
