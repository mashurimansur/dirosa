@extends('murobbi.layouts.main')

@section('content')
    <a href="{{ route('halaqah.create') }}" class="new-btn" title="Tambah Halaqah"><i class="glyphicon glyphicon-pencil"></i></a>
    <div class="bg-light lter b-b wrapper-md">
            <div>
                <form method="GET" action="{{ route('kader.kader') }}" class="navbar-form navbar-form-xs navbar-right shift" ui-shift="prependTo" data-target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" ng-model="selected" name="search" value="{{ Request::input('search') }}" typeahead="state for state in states | filter:$viewValue | limitTo:8" class="form-control input-sm bg-light no-border rounded padder" placeholder="Cari Mudarris">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        <h1 class="m-n font-thin h3">Data Kader</h1>
    </div>

    <div class="wrapper-md">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{-- <span class="label bg-danger pull-right m-t-sm"><a href="{{ route('halaqah.create') }}">Tambah Data</a></span> --}}
                    List Kader
                </div>
                <table class="table table-striped m-b-none">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>No. Telepon</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($kader as $k)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $k->name }}</td>
                                <td>{{ $k->email }}</td>
                                <td>{{ $k->gender == "l" ? "Laki-laki" : "Perempuan" }}</td>
                                <td>{{ $k->phone }}</td>
                                <td>{{ $k->address }}</td>
                            </tr>
                        @empty
                            <tr>
								<td colspan="6" align="center">Tidak ada data kader.</td>
							</tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-center m-t-lg m-b-lg">
                <ul class="pagination pagination-md">
                    {{ $kader->render() }}
                </ul>
            </div>
        </div>
    </div>
@endsection
