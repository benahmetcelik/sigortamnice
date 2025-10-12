@extends('themes.NiceTheme.layouts.app')

@section('title', 'İletişim - Nice Yazılım')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-white">İletişim</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-lg btn-outline-light" href="{{ route('home') }}">Anasayfa</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-lg btn-outline-light disabled" href="">İletişim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-6">
                    <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">İletişim</h6>
                    <h1 class="section-title mb-3">Bizimle İletişime Geçin</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="form-row">
                                <div class="col-sm-6 control-group">
                                    <input type="text" class="form-control p-4" id="name" placeholder="Adınız Soyadınız"
                                        required="required" data-validation-required-message="Lütfen adınızı giriniz" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="col-sm-6 control-group">
                                    <input type="email" class="form-control p-4" id="email" placeholder="Email Adresiniz"
                                        required="required" data-validation-required-message="Lütfen email adresinizi giriniz" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control p-4" id="subject" placeholder="Konu"
                                    required="required" data-validation-required-message="Lütfen konuyu giriniz" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control p-4" rows="6" id="message" placeholder="Mesajınız"
                                    required="required"
                                    data-validation-required-message="Lütfen mesajınızı giriniz"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton">Mesaj Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 400px;">
                    <div class="position-relative h-100 rounded overflow-hidden">
                        <iframe style="width: 100%; height: 100%; object-fit: cover;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3008.443771815454!2d28.97915937668641!3d41.037238571459504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab7650656bd63%3A0x8ca058b28c20b6c3!2zVGFrc2ltIE1leWRhbsSxLCBHw7xtw7zFn3N1eXUsIDM0NDM1IEJleW_En2x1L8Swc3RhbmJ1bA!5e0!3m2!1str!2str!4v1708561554387!5m2!1str!2str"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Contact Info Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-3x fa-map-marker-alt text-primary mr-4"></i>
                        <div>
                            <h5 class="text-primary">Ofisimiz</h5>
                            <p class="m-0">Taksim, İstanbul, Türkiye</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-3x fa-phone-alt text-primary mr-4"></i>
                        <div>
                            <h5 class="text-primary">Telefon</h5>
                            <p class="m-0">+90 555 123 45 67</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-3x fa-envelope text-primary mr-4"></i>
                        <div>
                            <h5 class="text-primary">Email</h5>
                            <p class="m-0">info@niceyazilim.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Info End -->
@endsection 