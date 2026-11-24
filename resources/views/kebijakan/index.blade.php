@extends('layouts.app')

@section('title', 'Kebijakan — PATEN PAK MIKO')
@section('page-title', 'Kebijakan')

@section('content')
    @include('layouts.partials.service-queue-table', [
        'serviceName' => 'Pertimbangan Teknis Pertanahan Kebijakan',
        'serviceDesc' => 'Permohonan berbasis mandat kebijakan pemerintah.',
        'routePrefix' => 'kebijakan',
        'layananSlug' => 'kebijakan',
        'applications' => $applications,
    ])
@endsection
