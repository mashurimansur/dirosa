@extends('front.layouts.main')

@section('content')
<div class="bg-light lter b-b wrapper-md">
    <h1 class="m-n font-thin h3">Detail Halaqah</h1>
</div>

<div class="wrapper-md" ng-controller="FormDemoCtrl">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">Detail Halaqah</div>
                <div class="panel-body">
                    <table class="table table-striped m-b-none">
                        <tbody>
                            <tr>
                                <th>Nama Halaqah :</th>
                                <td>{{ $halaqah->name }}</td>
                            </tr>
                            <tr>
                                <th>Nama Murobbi :</th>
                                <td>{{ $halaqah->murobbi->name }}</td>
                            </tr>
                            <tr>
                                <th>No. Telepon :</th>
                                <td>{{ $halaqah->murobbi->phone }}</td>
                            </tr>
                            <tr>
                                <th>Hari / Jam :</th>
                                <td>{{ $halaqah->day }} / {{ $halaqah->hour }}</td>
                            </tr>
                            <tr>
                                <th>Total Peserta :</th>
                                <td>{{ count($halaqah->users) }}</td>
                            </tr>
                            <tr>
                                <th>Jarak :</th>
                                <td id="jarak"></td>
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
                    @guest
                    @else
                        @if ($check > 0)
                            <div class="wrapper bg-white">
                                <button class="btn btn-success btn-sm">Anda telah bergabung</button>
                            </div>
                        @else
                            <div class="wrapper bg-white">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-delete">Gabung Halaqah</button>
                            </div>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">Lokasi</div>
                <div class="panel-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin=""/> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    {{-- <link rel="stylesheet" href="{{ asset('leaflet') }}/leaflet-routing-machine.css" /> --}}
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>



    <style>
        #mapid { height: 700px; }
    </style>
@endsection

@guest
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
    <script>
        document.getElementById("jarak").innerHTML = "Perhitungan jarak membutuhkan lokasi anda";
    </script>
    @endpush
@else
    @section('modal')
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Halaqah</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    Apakah anda ingin bergabung di halaqah ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('front.halaqah.join') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="halaqah_id" value="{{ $halaqah->id }}">
                        <button class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
        {{-- <script src="{{ asset('leaflet') }}/leaflet-routing-machine.js"></script> --}}
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
        <script src="{{ asset('leaflet') }}/Control.Geocoder.js"></script>

        <script>
            var map = L.map('mapid');

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.Routing.control({
                waypoints: [
                    L.latLng({{ Auth::user()->latitude }}, {{ Auth::user()->longitude }}),
                    L.latLng({{ $halaqah->latitude }}, {{ $halaqah->longitude }})
                ],
                routeWhileDragging: true
            }).addTo(map);

            console.log("tes1");
            var lat1 = L.latLng({{ Auth::user()->latitude }}, {{ Auth::user()->longitude }});
            var lat2 = L.latLng({{ $halaqah->latitude }}, {{ $halaqah->longitude }});
            var jarak = map.distance(lat1, lat2);
            console.log(jarak);
        </script>

        <script>
            function getDistance(origin, destination) {
                // return distance in meters
                var lon1 = toRadian(origin[1]),
                    lat1 = toRadian(origin[0]),
                    lon2 = toRadian(destination[1]),
                    lat2 = toRadian(destination[0]);

                var deltaLat = lat2 - lat1;
                var deltaLon = lon2 - lon1;

                var a = Math.pow(Math.sin(deltaLat/2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon/2), 2);
                var c = 2 * Math.asin(Math.sqrt(a));
                var EARTH_RADIUS = 6371;
                return c * EARTH_RADIUS;
            }

            function toRadian(degree) {
                return degree*Math.PI/180;
            }

            var distance = getDistance([{{ Auth::user()->latitude }}, {{ Auth::user()->longitude }}], [{{ $halaqah->latitude }}, {{ $halaqah->longitude }}])
            console.log("cek jarak dari rumus, ini bisa di cek offline");
            console.log(distance);
            document.getElementById("jarak").innerHTML = distance.toFixed(2) + " km";
        </script>
    @endpush

@endguest

