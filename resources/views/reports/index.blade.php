@extends('layouts.app', ['title' => 'List Laporan | ' .  env('APP_NAME') ])

@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Laporan</h1>
        <a class="btn btn-primary" href="{{ route('reports.export') }}">
            <i class="fas fa-file-download fa-sm text-white-50"></i>
            <span>Export</span>
        </a>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <span>{{ $message }}</span>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Laporan</h6>
                    <a class="btn btn-primary" href="{{ route('reports.create') }}">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Peta</th>
                                    <th>Informasi</th>
                                    <th>Tanggal dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Peta</th>
                                    <th>Informasi</th>
                                    <th>Tanggal dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($reports as $index => $report)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>
                                        <iframe
                                            width="600"
                                            height="450"
                                            frameborder="0"
                                            style="border:0"
                                            src="https://www.google.com/maps/embed/v1/place?q={{ $report->latitude }},{{ $report->longitude }}&key=AIzaSyA3B-nuvGKA7LmUy1joar-arOXfOVEP2vc"
                                            allowfullscreen>
                                        </iframe>
                                    </td>
                                    <td>{{ $report->information }}</td>
                                    <td>{{ $report->created_at }}</td>
                                    <td>
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                            {{-- <a class="btn btn-info" href="{{ route('reports.show',$report->id) }}">Show</a> --}}
                                            <a class="btn btn-primary mb-2" href="{{ route('reports.edit', $report->id) }}">
                                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                                Edit
                                            </a>

                                            @csrf
                                            @method('DELETE')

                                            <button  type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash fa-sm text-white-50"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
    $('#dataTable').DataTable();
    });
</script>

<script type="text/javascript">
    function initMap() {
      const myLatLng = { lat: 22.2734719, lng: 70.7512559 };
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: myLatLng,
      });

      new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Scrum!",
      });
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>
@endsection
