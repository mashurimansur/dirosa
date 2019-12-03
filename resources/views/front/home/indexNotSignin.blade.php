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
                                        <small class="text-muted clear text-ellipsis">{{ $h->day }} - {{ $h->hour }}</small>
                                        <small class="text-muted clear text-ellipsis">Tingkatan {{ $h->tiers }}</small>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- / tasks -->
            </div>
        </div>
        <!-- / main -->
        <!-- right col -->
        <div class="col w-md bg-white-only b-l bg-auto no-border-xs">
            <div>

            </div>
        </div>
    <!-- / right col -->
    </div>
@endsection
