@extends('layouts.app')

@section('title', 'Tanah Timbul — PATEN PAK MIKO')
@section('page-title', 'Tanah Timbul')

@section('content')
    @include('layouts.partials.service-queue-table', [
        'serviceName' => 'Pertimbangan Teknis Pertanahan Tanah Timbul',
        'serviceDesc' => 'Permohonan berbasis mandat Tanah Timbul pemerintah.',
        'routePrefix' => 'tanah-timbul',
        'layananSlug' => 'tanah-timbul',
        'applications' => $applications,
    ])
@endsection
