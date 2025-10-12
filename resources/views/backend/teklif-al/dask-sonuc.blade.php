@extends('themes.NiceTheme.layouts.app')

@section('title', 'DASK Teklif Sonuçları - Nice Yazılım')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-white">DASK Teklif Sonuçları</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-lg btn-outline-light" href="{{ route('home') }}">Anasayfa</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-lg btn-outline-light" href="{{ route('dask.index') }}">Yeni Teklif</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Teklif Sonuçları Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                @foreach($teklifler as $sigorta => $teklif)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0 text-center">
                                    @switch($sigorta)
                                        @case('nippon')
                                            Nippon Sigorta
                                            @break
                                        @case('allianz')
                                            Allianz Sigorta
                                            @break
                                        @case('axa')
                                            AXA Sigorta
                                            @break
                                        @case('mapfre')
                                            Mapfre Sigorta
                                            @break
                                        @case('anadolu')
                                            Anadolu Sigorta
                                            @break
                                    @endswitch
                                </h5>
                            </div>
                            <div class="card-body">
                                @if(isset($teklif['error']))
                                    <div class="alert alert-danger">
                                        {{ $teklif['error'] }}
                                    </div>
                                @else
                                    <div class="text-center mb-4">
                                        <h3 class="text-primary">{{ number_format($teklif['prim'], 2, ',', '.') }} TL</h3>
                                        <p class="text-muted">Yıllık Prim</p>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Teminat: {{ number_format($teklif['teminat'], 2, ',', '.') }} TL
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Poliçe No: {{ $teklif['police_no'] }}
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Geçerlilik: {{ $teklif['gecerlilik'] }}
                                        </li>
                                    </ul>
                                    <div class="text-center mt-4">
                                        <a href="{{ $teklif['teklif_url'] }}" class="btn btn-primary" target="_blank">
                                            Teklifi İncele
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Teklif Sonuçları End -->
@endsection 