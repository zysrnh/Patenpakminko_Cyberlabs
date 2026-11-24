@extends('layouts.app')

@section('title', 'Proyek Strategis Nasional (PSN) — PATEN PAK MIKO')
@section('page-title', 'Proyek Strategis Nasional (PSN)')

@section('content')
    @include('layouts.partials.service-queue-table', [
        'serviceName' => 'Proyek Strategis Nasional (PSN)',
        'serviceDesc' => 'Permohonan berbasis mandat Proyek Strategis Nasional (PSN) pemerintah.',
        'routePrefix' => 'psn',
        'layananSlug' => 'psn',
        'applications' => $applications,
    ])
@endsection
