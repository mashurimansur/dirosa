@extends('murobbi.layouts.main')

@section('content')
	<div class="bg-light lter b-b wrapper-md">
		<h1 class="m-n font-thin h3">Update Profile</h1>
	</div>
	<div class="wrapper-md">
		<div class="row">
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-body">
						<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }} {{ method_field('PUT') }}
							<div class="form-group">
								<label for="">Nama Lengkap</label>
								<input type="text" name="name" class="form-control" value="{{ $user->name }}" min="5" required>
							</div>

							<div class="form-group">
								<label for="">Email</label>
								<input type="email" name="email" class="form-control" placeholder="ex: example@mail.com" value="{{ $user->email }}" required>
							</div>

							<div class="form-group">
								<label for="">Jenis Kelamin</label>
								<select class="form-control" name="gender">
                                    <option value="l" {{ $user->gender == "l" ? "selected" : "" }}>Laki-laki</option>
                                    <option value="p" {{ $user->gender == "p" ? "selected" : "" }}>Perempuan</option>
								</select>
                            </div>

                            <div class="form-group">
								<label for="">No. Telepon</label>
								<input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                            </div>

                            <div class="form-group">
								<label for="">Alamat</label>
								<input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
							</div>

							<div class="form-group">
								<label for="">Profil Image</label>
								@if ($user->image != '')
									<br>
									<img src="{{ asset('uploads').'/'.$user->image }}" width="100%">
									<br>
									<br>
								@endif
								<input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png">
							</div>

							<div class="form-group">
								<label for="">Passsword</label>
								</label>
								<input type="password" name="password" class="form-control" min="5">
                            </div>

                            <div class="row hide">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude" class="control-label">{{ __('user.latitude') }}</label>
                                        <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', $user->latitude) }}" required>
                                        {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude" class="control-label">{{ __('user.longitude') }}</label>
                                        <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', $user->longitude) }}" required>
                                        {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

							<hr>

							<div class="row">
								<div class="col-md-12 text-right">
									<button type="submit" class="btn btn-primary">Add</button>
								</div>
							</div>
						</form>
					</div>
				</div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold">Horizontal form</div>
                    <div class="panel-body">
                        <div id="mapid"></div>
                    </div>
                </div>
            </div>

			<div class="col-md-4">
				@if (count($errors) > 0)
					<div class="alert-top alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin=""/>

    <style>
        #mapid { height: 500px; }
    </style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script>
    var mapCenter = [{{ $user->latitude }}, {{ $user->longitude }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
</script>
@endpush

