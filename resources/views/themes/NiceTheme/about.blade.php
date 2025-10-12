@extends('themes.NiceTheme.layouts.app')

@section('title', 'Hakkımızda - Nice Yazılım')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-white">Hakkımızda</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-lg btn-outline-light" href="{{ route('home') }}">Anasayfa</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-lg btn-outline-light disabled" href="">Hakkımızda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid" src="{{ asset('themes/NiceTheme/img/about.jpg') }}" alt="">
                </div>
                <div class="col-lg-7 mt-5 mt-lg-0 pl-lg-5">
                    <h6 class="text-secondary text-uppercase font-weight-medium mb-3">Bizi Tanıyın</h6>
                    <h1 class="mb-4">Yenilikçi Yazılım Çözümleri</h1>
                    <h5 class="font-weight-medium font-italic mb-4">Nice Yazılım olarak, modern teknolojilerle işinizi büyütmenize yardımcı oluyoruz.</h5>
                    <p class="mb-2">Nice Yazılım olarak, işletmelerin dijital dönüşüm süreçlerinde yanlarında oluyoruz. Web ve mobil uygulama geliştirme, e-ticaret çözümleri, kurumsal yazılımlar ve daha fazlası için profesyonel hizmetler sunuyoruz.</p>
                    <div class="row">
                        <div class="col-sm-6 pt-3">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check text-primary mr-2"></i>
                                <p class="text-secondary font-weight-medium m-0">Profesyonel Ekip</p>
                            </div>
                        </div>
                        <div class="col-sm-6 pt-3">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check text-primary mr-2"></i>
                                <p class="text-secondary font-weight-medium m-0">Modern Teknolojiler</p>
                            </div>
                        </div>
                        <div class="col-sm-6 pt-3">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check text-primary mr-2"></i>
                                <p class="text-secondary font-weight-medium m-0">Kaliteli Hizmet</p>
                            </div>
                        </div>
                        <div class="col-sm-6 pt-3">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check text-primary mr-2"></i>
                                <p class="text-secondary font-weight-medium m-0">7/24 Destek</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Features Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <h5 class="text-primary mb-4">Neden Biz?</h5>
                    <p>Nice Yazılım olarak, müşterilerimize en iyi hizmeti sunmak için sürekli kendimizi geliştiriyoruz.</p>
                </div>
                <div class="col-lg-4 mb-5">
                    <h5 class="text-primary mb-4">Vizyonumuz</h5>
                    <p>Teknoloji dünyasında öncü olmak ve müşterilerimize değer katmak için çalışıyoruz.</p>
                </div>
                <div class="col-lg-4 mb-5">
                    <h5 class="text-primary mb-4">Misyonumuz</h5>
                    <p>Yenilikçi çözümlerle işletmelerin dijital dönüşümüne katkıda bulunmak.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
@endsection 