@extends('murobbi.layouts.main')

@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Detail Halaqah</h1>
    </div>

    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-7">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Detail Kelompok Dirosa</div>
                    <div class="panel-body">
                        <table class="table table-striped m-b-none">
                            <tbody>
                                <tr>
                                    <th>Nama Kelompok :</th>
                                    <td>{{ $halaqah->name }}</td>
                                </tr>
                                <tr>
                                    <th>Hari / Jam :</th>
                                    <td>{{ $halaqah->day }} / {{ $halaqah->hour }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi :</th>
                                    <td>{{ $halaqah->location }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Registrasi :</th>
                                    <td>{{ $halaqah->start_registration }} s/d {{ $halaqah->end_registration }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="wrapper bg-white">
                            <a href="{{ route('halaqah.edit', ['id' => $halaqah->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Location</div>
                    <div class="panel-body">
                        <div id="mapid"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Daftar Anggota</div>
                    <div class="panel-body">
                        <table class="table table-striped m-b-none">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($halaqah->users as $user)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td><a href="#" class="btn btn-danger btn-xs">Keluarkan</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Kelompok Dirosa</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    Apakah Anda yakin ingin menghapus kelompok ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="{{ route('halaqah.delete', ['id' => $halaqah->id]) }}" type="submit" class="btn btn-danger">Ya</a>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin=""/>

    <style>
        #mapid { height: 206px; }
    </style>
@endsection

@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $halaqah->latitude }}, {{ $halaqah->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $halaqah->latitude }}, {{ $halaqah->longitude }}]).addTo(map);
</script>
@endpush

