@extends('front.layouts.main')

@section('content')
    <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="app.settings.asideFolded = false;app.settings.asideDock = false;">
    <!-- main -->
        <div class="col">
            <!-- main header -->
            <div class="bg-light lter b-b wrapper-md">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <h1 class="m-n font-thin h3 text-black">Home</h1>
                        <small class="text-muted">Selamat datang di aplikasi pencarian guru mengaji dirosa</small>
                    </div>
                </div>
            </div>
            <!-- / main header -->
            <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                <!-- tasks -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="list-group list-group-lg list-group-sp">
                            @foreach ($halaqah as $h)
                                <a href="{{ route('front.halaqah.detail', ['id' => $h->id]) }}" class="list-group-item clearfix">
                                    <span class="pull-left thumb-sm avatar m-r">
                                        <img src="{{ asset('uploads') }}/{{ $h->murobbi->image }}" alt="...">
                                        <i class="on b-white right"></i>
                                    </span>
                                    <span class="clear">
                                        <span>{{ $h->name }} - {{ $h->murobbi->name }}</span>
                                        {{-- <span class="pull-right label bg-primary inline m-t-sm">0 km</span> --}}
                                        <small class="text-muted clear text-ellipsis">{{ $h->day }} - {{ $h->hour }}</small>
                                        <small class="text-muted clear text-ellipsis">Kelompok {{ $h->tiers }}</small>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-center m-t-lg m-b-lg">
                        <ul class="pagination pagination-md">
                            {{ $halaqah->render() }}
                        </ul>
                    </div>
                </div>
                <!-- / tasks -->
            </div>
        </div>
        <!-- / main -->
        <!-- right col -->
        <div class="col w-md bg-white-only b-l bg-auto no-border-xs">
            <div>
                <div class="panel panel-default">
                        <div class="panel-heading font-bold">Filter with Algoritma <br>Floyd Warshall</div>
                        <div class="panel-body">
                            <form role="form" method="GET" action="{{ route('front.filter') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tingkatan</label>
                                    <select name="tiers" id="" class="form-control">
                                        <option value="">Semua Tingkatan</option>
                                        <option value="pemula">Pemula</option>
                                        <option value="menengah">Menengah</option>
                                        <option value="mahir">Mahir</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Hari</label>
                                    <select name="day" id="day" class="form-control">
                                        <option value="">Semua Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>

                                <div class="form-group" id="timeDisplay">
                                    <label>Waktu Dirosa</label>
                                    <select name="hour" id="time" class="form-control">

                                    </select>
                                    {{-- <input type="time" name="hour" class="form-control" placeholder="Waktu Dirosa"> --}}
                                </div>

                                <div class="form-group" id="timeDisplay">
                                    <label>Total Kelompok yg Ingin Ditampilkan</label>
                                    <input type="number" name="total" class="form-control" value="10" step="10" max="100">
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- / right col -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $("#timeDisplay").hide();
        $('#day').change(function(){
            var dayID = $(this).val();
            if(dayID){
                $("#timeDisplay").show();
                $.ajax({
                    type:"GET",
                    url:"{{url('api/halaqah/time')}}"+"/"+dayID,
                    success:function(res){
                        if(res.length > 0){
                            $("#time").empty();
                            $("#time").append('<option>Semua Jam</option>');
                            $.each(res,function(key,value){
                            $("#time").append('<option value="'+value.hour+'">'+value.hour+'</option>');
                        });
                        } else {
                            $("#time").empty();
                            $("#timeDisplay").hide();
                        }
                    }
                });
            } else {
                $("#time").empty();
                $("#timeDisplay").hide();
            }
        });
    </script>
@endpush
