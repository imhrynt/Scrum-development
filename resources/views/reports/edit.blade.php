@extends('layouts.app', ['title' => 'Ubah Laporan | ' .  env('APP_NAME')])

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah sebuah Laporan</h1>
        <a href="{{ route('reports.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>
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

    <div class="row mb-5">
        <div class="col-12">
            <form action="{{ route('reports.update', $report->id) }}" method="POST">
                @csrf
                @method('PUT')

                 <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div id="map" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Informasi:</strong>
                            <textarea class="form-control" style="height:150px" name="information" placeholder="Informasi">{{ $report->information }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="latitude" id="latitude" value="{{ $report->latitude }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ $report->longitude }}">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Ubah</button>
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
    function initMap() {
        const latitudeElement = document.getElementById('latitude');
        const longitudeElement = document.getElementById('longitude');
        let map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: parseFloat(latitudeElement.value), lng: parseFloat(longitudeElement.value) }, // Initial map center (e.g., Jakarta, Indonesia)
            zoom: 15 // Initial zoom level
        });

        let marker = new google.maps.Marker({
            map: map,
            draggable: true, // Allow the marker to be dragged
            position: { lat: parseFloat(latitudeElement.value), lng: parseFloat(longitudeElement.value) } // Initial marker position
        });
        // Add an event listener to the marker for when it's dragged
        google.maps.event.addListener(marker, 'dragend', function (event) {
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();
            latitudeElement.value = lat;
            longitudeElement.value = lng;
            // You can perform any actions with the coordinates here, such as updating input fields or making AJAX requests.
            // console.log('latitudeElement: ' + latitudeElement);
            // console.log('New Marker Position: ' + lat + ', ' + lng);
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
@endsection
