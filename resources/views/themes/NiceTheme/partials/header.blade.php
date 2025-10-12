<!-- Topbar Start -->
<div class="container-fluid bg-primary py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white pr-3" href="">SSS</a>
                    <span class="text-white">|</span>
                    <a class="text-white px-3" href="">Yardım</a>
                    <span class="text-white">|</span>
                    <a class="text-white pl-3" href="">Destek</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-3" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-3" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="" class="navbar-brand">
                <h1 class="m-0 text-secondary"><span class="text-primary">NICE</span>YAZILIM</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link active">Anasayfa</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">Hakkımızda</a>
                    <a href="{{ route('services') }}" class="nav-item nav-link">Hizmetler</a>
                    <a href="{{ route('pricing') }}" class="nav-item nav-link">Fiyatlandırma</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Blog</a>
                        <div class="dropdown-menu border-0 rounded-0 m-0">
                            <a href="{{ route('blog') }}" class="dropdown-item">Blog Listesi</a>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">İletişim</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End --> 