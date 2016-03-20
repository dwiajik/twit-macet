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

        $.each( places, function( index, value ) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(value.latitude, value.longitude),
                map: map,
                title: value.name
            });

            var contentString = value.query;
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqCYmeo01ZTavbm3vLcsGwtVTjYYF_Njg&callback=initMap" async defer></script>
@endpush