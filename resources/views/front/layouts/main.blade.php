<!DOCTYPE html>
<html lang="en" class="">

<head>
    @yield('title')
    @include('front.layouts.partials.meta')
    @yield('styles')
</head>

<body>
	<div class="app app-header-fixed">
        <!-- header -->
        @include('front.layouts.partials.header')
		<!-- / header -->

        <!-- aside -->
        @include('front.layouts.partials.aside')
		<!-- / aside -->

		<!-- content -->
		<div id="content" class="app-content" role="main">
			<div class="app-content-body ">
                @yield('content')
			</div>
		</div>
		<!-- /content -->

        <!-- footer -->
        @include('front.layouts.partials.footer')
		<!-- / footer -->

	</div>

    @include('front.layouts.partials.scripts')
    @yield('modal')
    @stack('scripts')

</body>

</html>
