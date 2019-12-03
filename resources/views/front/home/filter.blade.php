@extends('front.layouts.main')

@section('content')
    @php
        foreach($halaqah as $h) {
            $hasil[] = [
                'name' => $h->name,
                'latitude' => (float)$h->latitude,
                'longitude' => (float)$h->longitude
            ];
        }
    @endphp

    <div class="row">
        <div class="col-md-12">
            <div id="mapid"></div>

            <br>
            <br>

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
        // let map = L.map('mapid').setView([{{ Auth::user()->latitude }}, {{ Auth::user()->longitude }}], 14);
        let map = L.map('mapid');

        // const url = 'http://dirosa.gg/api/halaqah/filter';
        const url = "{{ route('api.halaqah.filter') }}" + "?gender={{ Request::input('gender') }}&tiers={{ Request::input('tiers') }}&day={{ Request::input('day') }}&hour={{ Request::input('hour') }}";
        // console.log(cek)
        // const url = "{{ route('api.halaqah.filter') }}";
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
                {attribution: '© OpenStreetMap contributors'}).addTo(map);

            let control = L.Routing.control({waypoints: wayPoints, draggableWaypoints: false, geocoder: L
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
                $('#tableListVisit thead tr').append(`<th><a href="">${item.name}</a></th>`);
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
                L.marker([parseFloat(item.latitude), parseFloat(item.longitude)]).addTo(map)
                    .bindPopup(`<br><b>Nama Halaqah :</b>  ${item.name} <br><b>Lokasi :</b>  ${item.location}`);
            })


        })
        .catch(err => {
            // Do something for an error here
        })

        // let data = {{ json_encode($hasil) }});
        // console.log(data)
        // let listVisit = [{
        //     name: {{ Auth::user()->name }},
        //     latitude: {{ Auth::user()->latitude }},
        //     longitude: {{ Auth::user()->longitude }}
        // }];

        // let home = [{
        //     name: {{ Auth::user()->name }},
        //     latitude: {{ Auth::user()->latitude }},
        //     longitude: {{ Auth::user()->longitude }}
        // }];

        // const dataLength = data.length;

        // //Metode Floyd Warshall
        // for (let i = 0 + 1; i <= dataLength; i++) {
        //     if (i === 0) {
        //         listVisit[i] = data[i];
        //         data.splice(i, 1);
        //     } else {
        //         let willVisit;
        //         let nearly = 999999999999999999;
        //         data.map((item, index) => {
        //             let len = listVisit.length - 1;
        //             if (listVisit[len].name !== item.name) {
        //                 let distance = map.distance({
        //                     lat: listVisit[len].latitude,
        //                     lon: listVisit[len].longitude
        //                 }, {
        //                     lat: item.latitude,
        //                     lon: item.longitude,
        //                 });

        //                 if (nearly > distance) {
        //                     nearly = distance;
        //                     willVisit = index;
        //                 }
        //             }
        //         });
        //         listVisit[i] = data[willVisit];
        //         data.splice(willVisit, 1);
        //     }
        // };

        // let wayPoints = []
        // home.map(item => {
        //     wayPoints.push(L.latLng(parseFloat(item.latitude), parseFloat(item.longitude)))
        // }),
        // listVisit.map(item => {
        //     wayPoints.push(L.latLng(parseFloat(item.latitude), parseFloat(item.longitude)))
        // })

        // L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png',
        //     {attribution: '© OpenStreetMap contributors'}).addTo(map);

        // let control = L.Routing.control({waypoints: wayPoints, draggableWaypoints: false, geocoder: L
        //         .Control
        //         .Geocoder
        //         .nominatim()
        //     }).on('routingerror', function (e) {
        //         try {
        //             map.getCenter();
        //         } catch (e) {
        //             map.fitBounds(L.latLngBounds(control.getWaypoints().map(function (wp) {
        //                 return wp.latLng;
        //             })));
        //         }
        //     }).addTo(map);

        // listVisit.map((item, index) => {
        //     $('#tableListVisit thead tr').append(`<th>${item.name}</th>`);
        //     $('#tableListVisit tbody').append(`<tr><td><b>${item.name}</b></td></tr>`);
        //     listVisit.map(item2 => {
        //         let distance = map.distance({
        //             lat: item.latitude,
        //             lon: item.longitude
        //         }, {
        //             lat: item2.latitude,
        //             lon: item2.longitude,
        //         });
        //         if (item !== item2) {
        //             $(`#tableListVisit tbody tr:nth-child(${index + 1})`).append(`<td>${(distance / 1000).toFixed(2)} km</td>`)
        //         } else {
        //             $(`#tableListVisit tbody tr:nth-child(${index + 1})`).append(`<td>0 km</td>`)
        //         }
        //     })
        // })

        // listVisit.map((item, index) => {
        //     L.marker([parseFloat(item.latitude), parseFloat(item.longitude)]).addTo(map)
        //         .bindPopup(`<br><b>Lokasi :</b>  ${item.name}`);
        // })
    </script>


@endpush
