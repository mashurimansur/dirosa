@extends('front.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="mapid"></div>

            <br>
            <div class="bg-light lter b-b wrapper-md">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <h1 class="m-n font-thin h3 text-black">Hasil Perhitungan Algoritma Floyd Warshall</h1>
                        {{-- <small class="text-muted">Selamat datang di aplikasi pencarian guru mengaji dirosa</small> --}}
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <table id="tableListVisit" class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="app.settings.asideFolded = false;app.settings.asideDock = false;">
        <div class="col">
            <div class="bg-light lter b-b wrapper-md">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <h1 class="m-n font-thin h3 text-black">Daftar Rekomendasi Tempat Belajar Dirosa</h1>
                        {{-- <small class="text-muted">Selamat datang di aplikasi pencarian guru mengaji dirosa</small> --}}
                    </div>
                </div>
            </div>
            <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                <div class="row">
                    <div class="col-md-12" id="groupList">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    {{-- <link rel="stylesheet" href="{{ asset('leaflet') }}/leaflet-routing-machine.css" /> --}}
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>

    <style>
        #mapid { height: 700px; }
    </style>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    {{-- <script src="{{ asset('leaflet') }}/leaflet-routing-machine.js"></script> --}}
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="{{ asset('leaflet') }}/Control.Geocoder.js"></script>

    <script>
        let map = L.map('mapid').setView([{{ Auth::user()->latitude }}, {{ Auth::user()->longitude }}], 14);

        const url = "{{ route('api.halaqah.filter') }}" + "?total={{ Request::input('total') }}&tiers={{ Request::input('tiers') }}&day={{ Request::input('day') }}&hour={{ Request::input('hour') }}";
        fetch(url)
        .then(response => {
            return response.json()
        })
        .then(data => {
            // Work with JSON data here
            const dataLength = data.length;

            let listVisit = [{
                name: "You",
                latitude: {{ Auth::user()->latitude }},
                longitude: {{ Auth::user()->longitude }}
            }];

            let home = [{
                name: "You",
                latitude: {{ Auth::user()->latitude }},
                longitude: {{ Auth::user()->longitude }}
            }];

            console.log(dataLength)
            console.table(data)

            //Metode Floyd Warshall
            for (let i = 0 + 1; i <= dataLength; i++) {
                if (i === 0) {
                    listVisit[i] = data[i];
                    data.splice(i, 1);
                } else {
                    let willVisit;
                    let nearly = 999999999999999999;
                    data.map((item, index) => {
                        let len = listVisit.length - 1;
                        if (listVisit[len].name !== item.name) {
                            let distance = map.distance({
                                lat: listVisit[len].latitude,
                                lon: listVisit[len].longitude
                            }, {
                                lat: item.latitude,
                                lon: item.longitude,
                            });

                            if (nearly > distance) {
                                nearly = distance;
                                willVisit = index;
                            }
                        }
                    });
                    listVisit[i] = data[willVisit];
                    data.splice(willVisit, 1);
                }
            };

            let wayPoints = []
            home.map(item => {
                wayPoints.push(L.latLng(parseFloat(item.latitude), parseFloat(item.longitude)))
            }),
            listVisit.map(item => {
                wayPoints.push(L.latLng(parseFloat(item.latitude), parseFloat(item.longitude)))
            })

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png',
                {attribution: '© OpenStreetMap contributors & Mashuri M'}).addTo(map);

            let control = L.Routing.control({icon:greenIcon, waypoints: wayPoints, draggableWaypoints: false, geocoder: L
                    .Control
                    .Geocoder
                    .nominatim()
                }).on('routingerror', function (e) {
                    try {
                        map.getCenter();
                    } catch (e) {
                        map.fitBounds(L.latLngBounds(control.getWaypoints().map(function (wp) {
                            return wp.latLng;
                        })));
                    }
                }).addTo(map);

            listVisit.map((item, index) => {
                $('#tableListVisit thead tr').append(`<th>${item.name}</th>`);
                $('#tableListVisit tbody').append(`<tr><td><b>${item.name}</b></td></tr>`);
                listVisit.map(item2 => {
                    let distance = map.distance({
                        lat: item.latitude,
                        lon: item.longitude
                    }, {
                        lat: item2.latitude,
                        lon: item2.longitude,
                    });
                    if (item !== item2) {
                        $(`#tableListVisit tbody tr:nth-child(${index + 1})`).append(`<td>${(distance / 1000).toFixed(2)} km</td>`)
                    } else {
                        $(`#tableListVisit tbody tr:nth-child(${index + 1})`).append(`<td>0 km</td>`)
                    }
                })
            })

            listVisit.map((item, index) => {
                if (item.name != "You") {
                    $('#groupList').append(`
                        <div class="list-group list-group-lg list-group-sp">
                            <a href="http://dirosa.xyz/halaqah/${item.id}" class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="http://dirosa.xyz/uploads/${item.murobbi.image}" alt="...">
                                    <i class="on b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>${item.name} - ${item.murobbi.name}</span>
                                    <small class="text-muted clear text-ellipsis">${item.day} - ${item.hour}</small>
                                    <small class="text-muted clear text-ellipsis">Kelompok ${item.tiers}</small>
                                </span>
                            </a>
                        </div>
                    `);
                }
            })

            var greenIcon = new L.Icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41],
            });
            // var numMarker = L.ExtraMarkers.icon({
            //     icon: 'fa-number',
            //     number: 12,
            //     markerColor: 'blue'
            // });

            listVisit.map((item, index) => {
                if (item.name == "You") {
                    L.marker([parseFloat(item.latitude), parseFloat(item.longitude)]).addTo(map)
                    .bindPopup(`<br><b>Nama Kader :</b>  ${item.name}`);
                } else {
                    L.marker([parseFloat(item.latitude), parseFloat(item.longitude)], {icon: greenIcon}).addTo(map)
                        .bindPopup(`<br><b>Nama Kelompok :</b>  ${item.name} <br><b>Lokasi :</b>  ${item.location}`);
                }
            })

        })
        .catch(err => {
            // Do something for an error here
        })

    </script>
@endpush
