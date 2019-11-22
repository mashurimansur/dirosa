@extends('murobbi.layouts.main')

@section('content')
    <a href="{{ route('halaqah.create') }}" class="new-btn" title="Tambah Halaqah"><i class="glyphicon glyphicon-pencil"></i></a>
    <div class="bg-light lter b-b wrapper-md">
        <h1 class="m-n font-thin h3">Halaqah</h1>
    </div>

    <div class="wrapper-md">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{-- <span class="label bg-danger pull-right m-t-sm"><a href="{{ route('halaqah.create') }}">Tambah Data</a></span> --}}
                    Tasks
                </div>
                <table class="table table-striped m-b-none">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Halaqah</th>
                            <th>Tingkatan</th>
                            <th>Hari Dirosa</th>
                            <th>Waktu Dirosa</th>
                            <th>Lokasi Dirosa</th>
                            <th>Total Peserta</th>
                            <th>Waktu Pendaftaran </th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($halaqah as $h)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><a href="{{ route('halaqah.detail', ['id' => $h->id]) }}">{{ $h->name }}</a></td>
                                <td>{{ $h->tiers }}</td>
                                <td>{{ $h->day }}</td>
                                <td>{{ $h->hour }}</td>
                                <td>{{ $h->location }}</td>
                                <td>{{ count($h->users) }}</td>
                                <td>{{ $h->start_registration }} s/d {{ $h->end_registration }}</td>
                                <td>
                                    @if ($h->start_registration >= date("Y-m-d") || $h->end_registration <= date("Y-m-d"))
                                        <button disabled="disabled" class="btn btn-danger btn-sm">Tutup</button>
                                    @else
                                        <button disabled="disabled" class="btn btn-success btn-sm">Buka</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('halaqah.detail', ['id' => $h->id]) }}" class="btn btn-default btn-sm">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
