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
                        <small class="text-muted">Welcome to angulr application</small>
                    </div>
                </div>
            </div>
            <!-- / main header -->
            <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                <!-- tasks -->
                <div class="row">

                    <div class="col-md-12">
                        <div class="list-group list-group-lg list-group-sp">
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="{{ asset('murobbi') }}/img/a4.jpg" alt="...">
                                    <i class="on b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Chris Fox</span>
                                    <span class="pull-right label bg-primary inline m-t-sm">7km</span>
                                    <small class="text-muted clear text-ellipsis">What's up, buddy</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="{{ asset('murobbi') }}/img/a5.jpg" alt="...">
                                    <i class="on b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Amanda Conlan</span>
                                    <small class="text-muted clear text-ellipsis">Come online and we need
                                        talk about the plans that we have discussed</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="{{ asset('murobbi') }}/img/a6.jpg" alt="...">
                                    <i class="busy b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Dan Doorack</span>
                                    <small class="text-muted clear text-ellipsis">Hey, Some good
                                        news</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="{{ asset('murobbi') }}/img/a7.jpg" alt="...">
                                    <i class="busy b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Lauren Taylor</span>
                                    <small class="text-muted clear text-ellipsis">Nice to talk with
                                        you.</small>
                                </span>
                            </a>
                            <a herf class="list-group-item clearfix">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <img src="{{ asset('murobbi') }}/img/a8.jpg" alt="...">
                                    <i class="away b-white right"></i>
                                </span>
                                <span class="clear">
                                    <span>Mike Jackson</span>
                                    <small class="text-muted clear text-ellipsis">This is nice</small>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- / tasks -->
            </div>
        </div>
        <!-- / main -->
        <!-- right col -->
        <div class="col w-md bg-white-only b-l bg-auto no-border-xs">
            <div data-ng-include=" 'tpl/blocks/aside.right.html' ">

            </div>
        </div>
    <!-- / right col -->
    </div>
@endsection
