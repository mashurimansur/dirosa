@extends('murobbi.layouts.main')

@section('content')
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Edit Halaqah</h1>
    </div>

    <div class="wrapper-md" ng-controller="FormDemoCtrl">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Form</div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ route('halaqah.update', ['id' => $halaqah->id]) }}">
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="form-group">
                                <label>Nama Halaqah</label>
                                <input type="text" name="name" class="form-control" value="{{ $halaqah->name }}" placeholder="Nama Halaqah">
                            </div>
                            <div class="form-group">
                                <label>Tingkatan</label>
                                <select name="tiers" id="" class="form-control">
                                    <option value="Pemula" {{ $halaqah->tiers == "pemula" ? "selected" : "" }}>Pemula</option>
                                    <option value="Menengah" {{ $halaqah->tiers == "menengah" ? "selected" : "" }}>Menengah</option>
                                    <option value="Mahir" {{ $halaqah->tiers == "mahir" ? "selected" : "" }}>Mahir</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Hari</label>
                                <select name="day" id="" class="form-control">
                                    <option value="Senin" {{ $halaqah->day == "Senin" ? "selected" : "" }}>Senin</option>
                                    <option value="Selasa" {{ $halaqah->day == "Selasa" ? "selected" : "" }}>Selasa</option>
                                    <option value="Rabu" {{ $halaqah->day == "Rabu" ? "selected" : "" }}>Rabu</option>
                                    <option value="Kamis" {{ $halaqah->day == "Kamis" ? "selected" : "" }}>Kamis</option>
                                    <option value="Jumat" {{ $halaqah->day == "Jumat" ? "selected" : "" }}>Jumat</option>
                                    <option value="Sabtu" {{ $halaqah->day == "Sabtu" ? "selected" : "" }}>Sabtu</option>
                                    <option value="Minggu" {{ $halaqah->day == "Minggu" ? "selected" : "" }}>Minggu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Waktu Dirosa</label>
                                <input type="time" name="hour" class="form-control" value="{{ $halaqah->hour }}" placeholder="Waktu Dirosa">
                            </div>

                            <div class="form-group">
                                <label>Lokasi Dirosa</label>
                                <input type="text" name="location" value="{{ $halaqah->location }}" class="form-control" placeholder="Lokasi Dirosa">
                            </div>

                            <div class="form-group">
                                <label>Taggal Mulai Pendaftaran</label>
                                <input type="date" name="start_registration" value="{{ $halaqah->start_registration }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Terakhir Pendaftaran</label>
                                <input type="date" name="end_registration" value="{{ $halaqah->end_registration }}" class="form-control">
                            </div>

                            <div class="row hide">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude" class="control-label">{{ __('halaqah.latitude') }}</label>
                                        <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', $halaqah->latitude) }}" required>
                                        {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude" class="control-label">{{ __('halaqah.longitude') }}</label>
                                        <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', $halaqah->longitude) }}" required>
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
    var mapCenter = [{{ $halaqah->latitude }}, {{ $halaqah->longitude }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.detail_zoom_level') }});

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
</script>
@endpush

