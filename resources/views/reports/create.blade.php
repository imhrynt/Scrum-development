@extends('layouts.app', ['title' => 'Tambah Laporan | ' .  env('APP_NAME') ])

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah sebuah Laporan</h1>
        <a href="{{ route('reports.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <button class="btn btn-sm btn-primary" id="coordinateButton">Ambil Koordinat</button>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <span id="alamat"></span>
    </div>
    {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tambah sebuah Laporan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('reports.index') }}"> Kembali</a>
            </div>
        </div>
    </div> --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada yang salah dengan Input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf

                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">

                        <div class="form-group">
                            {{-- <strong>Name:</strong> --}}
                            <div id="map" style="width: 100%; height: 400px;"></div>
                            {{-- <input type="text" name="name" class="form-control" placeholder="Name"> --}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Informasi:</strong>
                            <textarea class="form-control" style="height:150px" name="information" placeholder="Informasi"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="latitude" id="latitude" value="-6.2088">
                    <input type="hidden" name="longitude" id="longitude" value="106.8456">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection


@section('scripthead')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}"></script>
@endsection

@section('script')
<script>
    let map;
    let marker;
    let geocoder;
    const coordinateButton = document.querySelector('#coordinateButton');
    function initMap() {
        const latitudeElement = document.getElementById('latitude');
        const longitudeElement = document.getElementById('longitude');
        const defaultPosition = { lat: -6.2088, lng: 106.8456 };
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultPosition, // Initial map center (e.g., Jakarta, Indonesia)
            zoom: 15 // Initial zoom level
        });
        // Request the user's location
        geocodePosition(defaultPosition);
        getCurrentPosition();
        marker = new google.maps.Marker({
            map: map,
            draggable: true, // Allow the marker to be dragged
            position: defaultPosition // Initial marker position
        });

        // Add an event listener to the marker for when it's dragged
        google.maps.event.addListener(marker, 'dragend', function (event) {
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();
            latitudeElement.value = lat;
            longitudeElement.value = lng;
            geocodePosition({
                lat,
                lng
            });
            // You can perform any actions with the coordinates here, such as updating input fields or making AJAX requests.
        });
    }

    function getCurrentPosition() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(userLocation);
                marker.setPosition(userLocation);
                geocodePosition(userLocation);
                // You can use the user's location in your application
                console.log(userLocation);
            });
        } else {
            console.error("Geolocation is not suppported by this browser!");
        }
    }

    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                updateMarkerAddress(responses[0].formatted_address);
            } else {
                updateMarkerAddress('Tidak dapat menemukan alamat untuk lokasi ini.');
            }
        });
    }

    function updateMarkerAddress(address) {
        document.getElementById('alamat').innerHTML = address;
    }

    coordinateButton.addEventListener('click', function (e) {
        // console.log('aa');
        e.preventDefault();
        getCurrentPosition();
    })
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
@endsection
