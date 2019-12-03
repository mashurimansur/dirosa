@extends('murobbi.layouts.main')

@section('content')
<div class="hbox hbox-auto-xs hbox-auto-sm">
        <!-- main -->
        <div class="col">
            <div class="card">
                <div class="card-body" id="mapid"></div>
            </div>

            <div class="wrapper-md bg-white-only b-b">
                <div class="row text-center">
                    <div class="col-sm-4 col-xs-6">
                        <div>Total Kader/Users</div>
                        <div class="h2 m-b-sm">{{ $users }}</div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <div>Total Mudarris</div>
                        <div class="h2 m-b-sm">{{ $murobbi }}</div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <div>Total Kelompok Dirosa</div>
                        <div class="h2 m-b-sm">{{ $halaqah }}</div>
                    </div>
                </div>
            </div>
            {{-- <div class="wrapper-md">
                <!-- users -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="list-group list-group-lg list-group-sp">
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="img/a4.jpg" alt="...">
                                    <i class="on b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Chris Fox</span>
                                    <small class="text-muted clear text-ellipsis">What's up, buddy</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="img/a5.jpg" alt="...">
                                    <i class="on b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Amanda Conlan</span>
                                    <small class="text-muted clear text-ellipsis">Come online and we need talk about the plans that we have discussed</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="img/a6.jpg" alt="...">
                                    <i class="busy b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Dan Doorack</span>
                                    <small class="text-muted clear text-ellipsis">Hey, Some good news</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="img/a7.jpg" alt="...">
                                    <i class="busy b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Lauren Taylor</span>
                                    <small class="text-muted clear text-ellipsis">Nice to talk with you.</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="img/a8.jpg" alt="...">
                                    <i class="away b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Mike Jackson</span>
                                    <small class="text-muted clear text-ellipsis">This is nice</small>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel no-border">
                            <div class="panel-heading wrapper b-b b-light">
                                <span class="text-xs text-muted pull-right">
                                    <i class="fa fa-circle text-primary m-r-xs"></i> 12
                                    <i class="fa fa-circle text-info m-r-xs m-l-sm"></i> 30
                                    <i class="fa fa-circle text-warning m-r-xs m-l-sm"></i> 98
                                </span>
                                <h5 class="font-thin m-t-none m-b-none text-muted">Teammates</h5>
                            </div>
                            <ul class="list-group list-group-lg m-b-none">
                                <li class="list-group-item">
                                    <a href class="thumb-sm m-r">
                                        <img src="img/a1.jpg" class="r r-2x">
                                    </a>
                                    <span class="pull-right label bg-primary inline m-t-sm">Admin</span>
                                    <a href>Damon Parker</a>
                                </li>
                                <li class="list-group-item">
                                    <a href class="thumb-sm m-r">
                                        <img src="img/a2.jpg" class="r r-2x">
                                    </a>
                                    <span class="pull-right label bg-info inline m-t-sm">Member</span>
                                    <a href>Joe Waston</a>
                                </li>
                                <li class="list-group-item">
                                    <a href class="thumb-sm m-r">
                                        <img src="img/a3.jpg" class="r r-2x">
                                    </a>
                                    <span class="pull-right label bg-warning inline m-t-sm">Editor</span>
                                    <a href>Jannie Dvis</a>
                                </li>
                                <li class="list-group-item">
                                    <a href class="thumb-sm m-r">
                                        <img src="img/a4.jpg" class="r r-2x">
                                    </a>
                                    <span class="pull-right label bg-warning inline m-t-sm">Editor</span>
                                    <a href>Emma Welson</a>
                                </li>
                            </ul>
                            <div class="panel-footer">
                                <span class="pull-right badge badge-bg m-t-xs">32</span>
                                <button class="btn btn-primary btn-addon btn-sm"><i class="fa fa-plus"></i>Add Teammate</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / users -->
            </div> --}}
        </div>
        <!-- / main -->
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin=""/>
    <style>
        #mapid { min-height: 500px; }
    </style>
@endsection

@push('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>

    <script>
        var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }}, {{ config('leaflet.map_center_longitude') }}], {{ config('leaflet.zoom_level') }});
        var baseUrl = "{{ route('dashboard.index') }}";

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        axios.get('{{ route('api.halaqah.index') }}')
        .then(function (response) {
            console.log(response.data);
            L.geoJSON(response.data, {
                pointToLayer: function(geoJsonPoint, latlng) {
                    return L.marker(latlng);
                }
            })
            .bindPopup(function (layer) {
                return layer.feature.properties.map_popup_content;
            })
            .addTo(map);
        })
        .catch(function (error) {
            console.log(error);
        });
    </script>
@endpush

