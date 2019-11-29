<!DOCTYPE html>
<html lang="en" class="">
<head>
	<meta charset="utf-8" />
	<title>Dirosa - Login</title>
	<meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="stylesheet" href="{{ asset('murobbi') }}/libs/assets/animate.css/animate.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('murobbi') }}/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('murobbi') }}/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('murobbi') }}/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />

	<link rel="stylesheet" href="{{ asset('murobbi') }}/css/font.css" type="text/css" />
	<link rel="stylesheet" href="{{ asset('murobbi') }}/css/app.css" type="text/css" />

</head>
<body>
<div class="app app-header-fixed">


<div class="container w-xxl w-auto-xs">
	<a href class="navbar-brand block m-t">Dirosa - Login</a>
	<div class="m-b-lg">
		<div class="wrapper text-center">
			<strong>Silahkan login</strong>
        </div>
		<form name="form" class="form-validation" method="POST" action="{{ route('login') }}">
            @csrf
			<div class="text-danger wrapper text-center">
                @if ( count($errors) )
                    <div class="form-group">
                        <label class="form-label">Email atau kata sandi salah</label>
                    </div>
                @endif
            </div>

			<div class="list-group list-group-sm">
				<div class="list-group-item">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control no-border" required>
				</div>
				<div class="list-group-item">
                    <input type="password" name="password" placeholder="Password" class="form-control no-border" required>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
                <br>
			</div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
            {{-- @if (Route::has('password.request'))
			    <div class="text-center m-t m-b"><a href="{{ route('password.request') }}">Forgot password?</a></div>
            @endif --}}
		</form>
	</div>
	<div class="text-center">
		<p>
			<small class="text-muted">Mashuri Mansur<br>&copy; 2019</small>
		</p>
	</div>
</div>


</div>

<script src="{{ asset('murobbi') }}/libs/jquery/jquery/dist/jquery.js"></script>
<script src="{{ asset('murobbi') }}/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="{{ asset('murobbi') }}/js/ui-load.js"></script>
<script src="{{ asset('murobbi') }}/js/ui-jp.config.js"></script>
<script src="{{ asset('murobbi') }}/js/ui-jp.js"></script>
<script src="{{ asset('murobbi') }}/js/ui-nav.js"></script>
<script src="{{ asset('murobbi') }}/js/ui-toggle.js"></script>
<script src="{{ asset('murobbi') }}/js/ui-client.js"></script>

</body>
</html>
