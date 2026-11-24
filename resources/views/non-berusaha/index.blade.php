@extends('layouts.app')

@section('title', 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha — PATEN PAK MIKO')
@section('page-title', 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha')

@section('content')
    @include('layouts.partials.service-queue-table', [
        'serviceName' => 'Pertimbangan Teknis Pertanahan PKKPR Non Berusaha',
        'serviceDesc' => 'Permohonan kesesuaian ruang untuk rumah tinggal, keagamaan, sosial, dan fasilitas umum.',
        'routePrefix' => 'non-berusaha',
        'layananSlug' => 'non-berusaha',
        'applications' => $applications,
    ])
@endsection
