<!DOCTYPE html>
<html lang="en" class="">
<head>
    @include('murobbi.layouts.partials.meta')
    @yield('title')
    @yield('styles')
</head>
    <body>
        <div class="app app-header-fixed">

            <!-- header -->
            @include('murobbi.layouts.partials.header')
            <!-- / header -->

            <!-- aside -->
            @include('murobbi.layouts.partials.aside')
            <!-- / aside -->

            <!-- content -->
            <div id="content" class="app-content" role="main">
                <div class="app-content-body ">
                   @yield('content')
                </div>
            </div>
            <!-- /content -->

            <!-- footer -->
            @include('murobbi.layouts.partials.footer')
            <!-- / footer -->
        </div>

        @include('murobbi.layouts.partials.scripts')
        @stack('scripts')
    </body>
</html>
