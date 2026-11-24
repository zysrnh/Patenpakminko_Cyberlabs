@extends('layouts.app')

@section('title', 'Pertimbangan Teknis Pertanahan PKKPR Berusaha — PATEN PAK MIKO')
@section('page-title', 'Pertimbangan Teknis Pertanahan PKKPR Berusaha')

@section('content')
    @include('layouts.partials.service-queue-table', [
        'serviceName' => 'Pertimbangan Teknis Pertanahan PKKPR Berusaha',
        'serviceDesc' => 'Perizinan bisnis terpadu — skala mikro hingga besar.',
        'routePrefix' => 'berusaha',
        'layananSlug' => 'berusaha',
        'applications' => $applications,
    ])
@endsection
