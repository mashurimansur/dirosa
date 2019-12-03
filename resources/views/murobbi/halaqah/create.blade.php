@extends('murobbi.layouts.main')

@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Buat Kelompok Dirosa</h1>
    </div>

    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert-top alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Form</div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ route('halaqah.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Nama Kelompok</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama Halaqah">
                            </div>
                            <div class="form-group">
                                <label>Tingkatan</label>
                                <select name="tiers" id="" class="form-control">
                                    <option value="pemula">Pemula</option>
                                    <option value="menengah">Menengah</option>
                                    <option value="mahir">Mahir</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Hari</label>
                                <select name="day" id="" class="form-control">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Waktu Dirosa</label>
                                <input type="time" name="hour" class="form-control" placeholder="Waktu Dirosa">
                            </div>

                            <div class="form-group">
                                <label>Lokasi Dirosa</label>
                                <input type="text" name="location" class="form-control" placeholder="Lokasi Dirosa">
                            </div>

                            <div class="form-group">
                                <label>Taggal Mulai Pendaftaran</label>
                                <input type="date" name="start_registration" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Terakhir Pendaftaran</label>
                                <input type="date" name="end_registration" class="form-control">
                            </div>

                            <div class="row hide">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude" class="control-label">{{ __('outlet.latitude') }}</label>
                                        <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required>
                                        {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude" class="control-label">{{ __('outlet.longitude') }}</label>
                                        <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', request('longitude')) }}" required>
                                        {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Horizontal form</div>
                    <div class="panel-body">
                        <div id="mapid"></div>
                    </div>
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
        #mapid { height: 500px; }
    </style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script>
    var mapCenter = [{{ request('latitude', config('leaflet.map_center_latitude')) }}, {{ request('longitude', config('leaflet.map_center_longitude')) }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);

    var controlSearch = new L.Control.Search({
        position:'topleft',    // where do you want the search bar?
        layer: markersLayer,  // name of the layer
        initial: false,
        zoom: 11,        // set zoom to found location when searched
        marker: false,
        textPlaceholder: 'search...' // placeholder while nothing is searched
    });
    map.addControl(controlSearch); // add it to the map
</script>
@endpush

