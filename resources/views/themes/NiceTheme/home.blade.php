@extends('themes.NiceTheme.layouts.app')

@section('title', 'Anasayfa - Nice Yazılım')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('themes/NiceTheme/img/dask.png') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Zorunlu Deprem Sigortası</h4>
                            <h1 class="display-3 text-white mb-md-4">Konutlarınızı Güvence Altına Alın</h1>
                            <a href="/teklif-al/dask" class="btn btn-primary py-md-3 px-md-5 mt-2">Daha Fazla Bilgi</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('themes/NiceTheme/img/kasko.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Kasko</h4>
                            <h1 class="display-3 text-white mb-md-4">Araçlarınızı Güvence Altına Alın</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Daha Fazla Bilgi</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-secondary" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-secondary" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container-fluid py-5">
        <div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">DASK Teklifi Oluştur</h4>
                        <p class="text-muted mb-0">DASK sigortası teklifi için gerekli bilgileri girin</p>
                    </div>
{{--                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uavtModal">--}}
{{--                        <i class="fas fa-search me-1"></i> UAVT Kodu Bul--}}
{{--                    </button>--}}
                </div>
                <div class="card-body">


                    <form action="{{ route('admin.teklif-al.dask.store') }}" method="POST" class="contact-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Ad Soyad</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-posta</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{  old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefon</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{  old('phone') ?? '+90 ' }}" required>

                                    <div id="customer-search-result" class="mt-2"></div>
                                    @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Şehir</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                    @error('city')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label"><b>Adres : </b>
                                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="building_type" class="form-label">Bina Tipi</label>
                                    <select class="form-control form-select contact-form" id="building_type" name="building_type" required>
                                        <option value="">Seçiniz</option>
                                        <option value="apartment" {{ old('building_type') == 'apartment' ? 'selected' : '' }}>Apartman Dairesi</option>
                                        <option value="house" {{ old('building_type') == 'house' ? 'selected' : '' }}>Müstakil Ev</option>
                                        <option value="villa" {{ old('building_type') == 'villa' ? 'selected' : '' }}>Villa</option>
                                    </select>
                                    @error('building_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="building_age" class="form-label">Bina İnşaa Yılı</label>
                                    <input type="number" class="form-control" id="building_age" name="building_age" value="{{ old('building_age') }}" required>
                                    @error('building_age')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="building_size" class="form-label">Bina Büyüklüğü (m²)</label>
                                    <input type="number" class="form-control" id="building_size" name="building_size" value="{{ old('building_size') }}" required>
                                    @error('building_size')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Nippon Sigorta için ek alanlar -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="uavt_code" class="form-label">UAVT Kodu</label>
                                    <input type="text" class="form-control" id="uavt_code" name="uavt_code" value="{{ old('uavt_code') }}" required>
                                    @error('uavt_code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="building_usage" class="form-label">Bina Kullanım Amacı</label>
                                    <select class=" form-control form-select" id="building_usage" name="building_usage" required>
                                        <option value="">Seçiniz</option>
                                        <option value="MESKEN" {{ old('building_usage') == 'MESKEN' ? 'selected' : '' }}>Mesken</option>
                                        <option value="TİCARETHANE" {{ old('building_usage') == 'TİCARETHANE' ? 'selected' : '' }}>Ticarethane</option>
                                        <option value="DİĞER" {{ old('building_usage') == 'DİĞER' ? 'selected' : '' }}>Diğer</option>
                                    </select>
                                    @error('building_usage')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="building_floor" class="form-label">Bulunduğu Kat</label>
                                    <input type="number" class="form-control" id="building_floor" name="building_floor" value="{{ old('building_floor') }}" required>
                                    @error('building_floor')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="total_floors" class="form-label">Toplam Kat Sayısı</label>
                                    <input type="number" class="form-control" id="total_floors" name="total_floors" value="{{ old('total_floors') }}" required>
                                    @error('total_floors')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="building_material" class="form-label">Bina Yapı Malzemesi</label>
                                    <select class="form-control form-select" id="building_material" name="building_material" required>
                                        <option value="">Seçiniz</option>
                                        <option value="Çelik, betonarme" {{ old('building_material') == 'Çelik, betonarme' ? 'selected' : '' }}>Çelik, Betonarme</option>
                                        <option value="Diğer" {{ old('building_material') == 'Diğer' ? 'selected' : '' }}>Diğer</option>
                                    </select>
                                    @error('building_material')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="building_risk_class" class="form-label">Bina Risk Sınıfı</label>
                                    <select class="form-control form-select" id="building_risk_class" name="building_risk_class" required>
                                        <option value="">Seçiniz</option>
                                        <option value="1" {{ old('building_risk_class') == '1' ? 'selected' : '' }}>1. Sınıf</option>
                                        <option value="2" {{ old('building_risk_class') == '2' ? 'selected' : '' }}>2. Sınıf</option>
                                        <option value="3" {{ old('building_risk_class') == '3' ? 'selected' : '' }}>3. Sınıf</option>
                                        <option value="4" {{ old('building_risk_class') == '4' ? 'selected' : '' }}>4. Sınıf</option>
                                    </select>
                                    @error('building_risk_class')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="additional_info" class="form-label">Ek Bilgiler</label>
                                    <textarea class="form-control" id="additional_info" name="additional_info" rows="3">{{ old('additional_info') }}</textarea>
                                    @error('additional_info')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('admin.teklif-al.index') }}" class="btn btn-secondary me-2">İptal</a>
                            <button type="submit" class="btn btn-primary">Teklif Al</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        </div>
    </div>
    <!-- UAVT Kodu Bulma Modal -->
    <div class="modal fade" id="uavtModal" tabindex="-1" aria-labelledby="uavtModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uavtModalLabel">UAVT Kodu Bul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="bg-light p-2">
                            <h3 class="mb-4">UAVT Bul</h3>
                            <div class="col-12">

                                <div class="summary">
                                    <div class="alert" id="formAlert" role="alert"></div>


                                    <div class="form-floating mt-2">
                                        <select class="form-select dask-address-code" id="il-secim" data-status="1"
                                                data-next-name="district" name="city">
                                            <option value="">Seçiniz</option>
                                            <option value="034">İstanbul</option>
                                            <option value="006">Ankara</option>
                                            <option value="035">İzmir</option>
                                            <option value="001">Adana</option>
                                            <option value="002">Adıyaman</option>
                                            <option value="003">Afyon</option>
                                            <option value="004">Ağrı</option>
                                            <option value="068">Aksaray</option>
                                            <option value="005">Amasya</option>
                                            <option value="007">Antalya</option>
                                            <option value="075">Ardahan</option>
                                            <option value="008">Artvin</option>
                                            <option value="009">Aydın</option>
                                            <option value="010">Balıkesir</option>
                                            <option value="074">Bartın</option>
                                            <option value="072">Batman</option>
                                            <option value="069">Bayburt</option>
                                            <option value="011">Bilecik</option>
                                            <option value="012">Bingöl</option>
                                            <option value="013">Bitlis</option>
                                            <option value="014">Bolu</option>
                                            <option value="015">Burdur</option>
                                            <option value="016">Bursa</option>
                                            <option value="017">Çanakkale</option>
                                            <option value="018">Çankırı</option>
                                            <option value="019">Çorum</option>
                                            <option value="020">Denizli</option>
                                            <option value="021">Diyarbakır</option>
                                            <option value="081">Düzce</option>
                                            <option value="022">Edirne</option>
                                            <option value="023">Elazığ</option>
                                            <option value="024">Erzincan</option>
                                            <option value="025">Erzurum</option>
                                            <option value="026">Eskişehir</option>
                                            <option value="027">Gaziantep</option>
                                            <option value="028">Giresun</option>
                                            <option value="029">Gümüşhane</option>
                                            <option value="030">Hakkari</option>
                                            <option value="031">Hatay</option>
                                            <option value="076">Iğdır</option>
                                            <option value="032">Isparta</option>
                                            <option value="033">Mersin</option>
                                            <option value="078">Karabük</option>
                                            <option value="070">Karaman</option>
                                            <option value="036">Kars</option>
                                            <option value="037">Kastamonu</option>
                                            <option value="038">Kayseri</option>
                                            <option value="071">Kırıkkale</option>
                                            <option value="039">Kırklareli</option>
                                            <option value="040">Kırşehir</option>
                                            <option value="079">Kilis</option>
                                            <option value="041">Kocaeli</option>
                                            <option value="042">Konya</option>
                                            <option value="043">Kütahya</option>
                                            <option value="044">Malatya</option>
                                            <option value="045">Manisa</option>
                                            <option value="046">Kahramanmaraş</option>
                                            <option value="047">Mardin</option>
                                            <option value="048">Muğla</option>
                                            <option value="049">Muş</option>
                                            <option value="050">Nevşehir</option>
                                            <option value="051">Niğde</option>
                                            <option value="052">Ordu</option>
                                            <option value="080">Osmaniye</option>
                                            <option value="053">Rize</option>
                                            <option value="054">Sakarya</option>
                                            <option value="055">Samsun</option>
                                            <option value="056">Siirt</option>
                                            <option value="057">Sinop</option>
                                            <option value="058">Sivas</option>
                                            <option value="073">Şırnak</option>
                                            <option value="059">Tekirdağ</option>
                                            <option value="060">Tokat</option>
                                            <option value="061">Trabzon</option>
                                            <option value="062">Tunceli</option>
                                            <option value="063">Şanlıurfa</option>
                                            <option value="064">Uşak</option>
                                            <option value="065">Van</option>
                                            <option value="077">Yalova</option>
                                            <option value="066">Yozgat</option>
                                            <option value="067">Zonguldak</option>
                                        </select>
                                        <label for="il-secim">İl Seçiniz</label>
                                    </div>


                                    <div class="form-floating mt-2">

                                        <select class="form-select dask-address-code" id="ilce" data-status="2"
                                                name="district"
                                                data-prev-name="city" data-next-name="parish">
                                            <option value="">Seçiniz</option>
                                        </select>
                                        <label for="ilce">İlçe</label>


                                    </div>

                                    <div class="form-floating mt-2">

                                        <select class="form-select dask-address-code" id="bucak" data-status="3"
                                                data-prev-name="city" data-next-name="neighborhood" name="parish">
                                            <option value="">Seçiniz</option>
                                            <option value="2431">MERKEZ-MERKEZ</option>
                                        </select>
                                        <label class="bucak">Bucak / Köy</label>


                                    </div>


                                    <div class="form-floating mt-2">
                                        <select class="form-select dask-address-code" id="mahalle" data-status="4"
                                                data-next-name="street" name="neighborhood">
                                            <option value="">Seçiniz</option>

                                        </select>
                                        <label id="mahalle">Mahalle</label>

                                    </div>


                                    <div class="form-floating mt-2">

                                        <select class="form-select dask-address-code" id="sokak" data-status="5"
                                                data-prev-name="neighborhood" data-next-name="door_number"
                                                name="street">
                                            <option value="">Seçiniz</option>

                                        </select>
                                        <label id="sokak">Sokak</label>

                                    </div>


                                    <div class="form-floating mt-2">

                                        <select class="form-select dask-address-code" data-status="6"
                                                data-prev-name="neighborhood" id="door_no" data-next-name="flat_number"
                                                name="door_number">
                                            <option value="">Seçiniz</option>

                                        </select>
                                        <label for="door_no">Kapı Numarası</label>

                                    </div>


                                    <div class="form-floating mt-2">

                                        <select class="form-select dask-address-code" id="daire_no" name="flat_number">
                                            <option value="">Seçiniz</option>
                                        </select>
                                        <label for="daire_no">Daire Numarası</label>

                                    </div>



                                    <div class="form-group">
                                        <input type="hidden" name="recaptchaName"
                                               value="dask_adres_kodu_hesaplama_araci" autocomplete="off">
                                        <input type="hidden" name="recaptcha" autocomplete="off"
                                               value="HFcDYyY08TA0lzTzUHXhwWX1lYCX1NfX82dmdhPkVJCElABzlOIyJud3A3NWwSNlJNJl0XFEVBWQMMWA55DjlvcUJyJQoHWB8cQxBlWiQMbmw0b2cqUjAQGHctfhIAUAcfWxcQfRIQaXclJxcsVggWFhYROwogCiRoYCgvNRUjQQ4tSD0SFEVBFE4pHmpNVixAM34MYjsHcBMfYiJcchEsBy0YCkgcNlJNJl0XAVJGdQ">
                                        <input type="hidden" name="module_id" value="375">

                                        <article class="container mt-2" id="form-response" style="display: block;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="summary response ">
                                                        <div class="row align-self-center">

                                                            <div class="col-md-6 card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 text-end">
                                                                            <p class="text-muted mb-0 text-truncate">Adres</p>
                                                                            <h5 class="text-dark mt-1 mb-0" id="uavt-adress-response"></h5>
                                                                        </div> <!-- end col -->
                                                                    </div> <!-- end row-->
                                                                </div> <!-- end card body -->
                                                            </div>
                                                            <div class="col-md-6 card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 text-end">
                                                                            <p class="text-muted mb-0 text-truncate">UAVT Kodu</p>
                                                                            <h3 class="text-dark mt-1 mb-0" id="uavt-kodu-response"></h3>
                                                                        </div> <!-- end col -->
                                                                    </div> <!-- end row-->
                                                                </div> <!-- end card body -->
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">


                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Bupa-Acibadem-Sigorta_46505.svg"
                                alt="ACIBADEM SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Bupa-Acibadem-Sigorta_46505.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ACIBADEM SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">BUPA ACIBADEM SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Küçükbakkalköy Mah. Başar Sok. No: 20 34750 Ataşehir / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">153003619800017</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span
                                class="typography css-1yykyoh">acibademsaglik@hs02.kep.tr&nbsp;</span></div></div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Gulf-Sigorta_b1543.svg"
                                alt="AIG GULF SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Gulf-Sigorta_b1543.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">AIG GULF SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">AIG GULF SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Saray Mah. Dr. Adnan Büyükdeniz Cad. No: 4/2 Kat: 4-5 Akkom Ofis Park Cessas Plaza Ümraniye / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">87105236230018</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">gulfsigorta@hs02.kep.tr</span></div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ak-Sigorta_68264.svg"
                                alt="AK SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ak-Sigorta_68264.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">AK SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">AKSİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Poligon Cad. Buyaka 2 Sitesi No:8 Kule:1 Kat: 0-6 Ümraniye / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">35000302200016</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">aksigorta@hs02.kep.tr</span></div>
                       </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Allianz-Sigorta_bed53.svg"
                                alt="ALLIANZ SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Allianz-Sigorta_bed53.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ALLIANZ SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">ALLİANZ SİGORTA&nbsp;A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Küçükbakkalköy Mah Kayışdağı Cad No:1 34750&nbsp; Ataşehir / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">800001327000012</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">allianzsigorta@hs02.kep.tr</span>
                        </div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ana-Sigorta-image_a9ff7.svg"
                                alt="ANA SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ana-Sigorta-image_a9ff7.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ANA SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">ANA SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Maslak Mahallesi Büyükdere Caddesi Spine Tower Blok No:243 İç Kapı No:11 SARIYER  / İSTANBUL</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">0069106716900001</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">anasigorta@hs03.kep.tr</span></div>
                       </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Anadolu-Sigorta_2df3b.svg"
                                alt="ANADOLU SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Anadolu-Sigorta_2df3b.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ANADOLU SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">ANADOLU ANONİM TÜRK SİGORTA ŞİRKETİ</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Anadolu Sigorta, Rüzgarlıbahçe Mah. Çam Pınarı Sok. No: 6 34805
Beykoz / İstanbul</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">68006132739588</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">anadolusigorta@hs03.kep.tr</span>
                        </div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ankara-Sigorta_d3d1d.svg"
                                alt="ANKARA SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ankara-Sigorta_d3d1d.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ANKARA SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">ANKARA ANONİM TÜRK SİGORTA ŞİRKETİ</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Kozyatağı Mahallesi Sarı Kanarya Sok. K2 Plaza&nbsp;No: 14 Kat: 8-9-10-11 Kadıköy / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">69003970664932</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">ankarasigorta@hs01.kep.tr</span></div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Arex-Sigorta_4845e.svg"
                                alt="AREX SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Arex-Sigorta_4845e.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">AREX SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">AREX SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Kavacık Mah. Elbistan Sokak, Calinos Plaza No: 6/2 34810 BEYKOZ / İSTANBUL</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">74103244800001</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">arexsigorta@hs03.kep.tr</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Atlas-Mutuel-Sigorta-image-01_1d747.svg"
                                alt="ATLAS MUTUEL SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Atlas-Mutuel-Sigorta-image-01_1d747.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ATLAS MUTUEL SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">S.S. ATLAS SİGORTA KOOPERATİFİ</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Akdeniz Mah. Halit Ziya Bulvarı 1353 Sok. No:2 Kat:3 Konak / İzmir</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">102043196300001</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">atlassigorta@hs03.kep.tr</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Axa-Sigorta_3366e.svg"
                                alt="AXA SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Axa-Sigorta_3366e.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">AXA SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">AXA SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Meclisi Mebusan Cad. No:15 34433 Salıpazarı / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">649003994600011</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">axasigorta@hs02.kep.tr</span></div>
                       </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Bereket-Sigorta_ca84e.svg"
                                alt="BEREKET SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Bereket-Sigorta_ca84e.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">BEREKET SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">BEREKET SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Saray Mah. Dr. Adnan Büyükdeniz cd. B Blok No:8 Kat:1-2 P.K:34768 Ümraniye / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">467005844200011</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">bereketsigorta@hs02.kep.tr</span>
                        </div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Doga-Sigorta_d4f86.svg"
                                alt="DOĞA SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Doga-Sigorta_d4f86.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">DOĞA SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">DOĞA SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Spine Tower No:243 Büyükdere Cad., 34394 Maslak / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">302055622200001</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">dogasigorta@hs03.kep.tr</span></div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://d3trkelrtrnovx.cloudfront.net/public/dijipolcom/insurancefirm/eureko-logo-blue_0cfb4.svg"
                                alt="EUREKO SİGORTA"
                                data-src="https://d3trkelrtrnovx.cloudfront.net/public/dijipolcom/insurancefirm/eureko-logo-blue_0cfb4.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">EUREKO SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">EUREKO SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Altunizade Mah. Ord. Prof. Fahrettin Kerim Gökay Cad. No:20 34662 Üsküdar / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">8006752500014</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">eurekosigorta@hs03.kep.tr&nbsp;</span>
                        </div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/HDI-Sigorta_800af.svg"
                                alt="HDİ SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/HDI-Sigorta_800af.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">HDİ SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">HDİ SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Halide Edip Adıvar Mh. Darülaceze Cd. No:23 Şişli / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">178002935600012</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">hdisigorta@hs03.kep.tr</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Katilim-Emeklilik_1ca0f.svg"
                                alt="KATILIM EMEKLİLİK"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Katilim-Emeklilik_1ca0f.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">KATILIM EMEKLİLİK</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">KATILIM EMEKLİLİK VE HAYAT A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Saray Mahallesi Dr. Adnan Büyükdeniz Caddesi No:2 Akkom Ofis Park-Kelif Plaza Kat:2 Ümraniye / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">528064104700018</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span
                                class="typography css-1yykyoh">katilimemeklilik@hs03.kep.tr&nbsp;</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Koru-Sigorta_9042d.svg"
                                alt="KORU SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Koru-Sigorta_9042d.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">KORU SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">KORU SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">19 MAYIS MH. İNÖNÜ CD. ALİ İHSAN TÜZÜN İŞ MERKEZİ NO 96 34742 KOZYATAĞI KADIKÖY İstanbul - Türkiye</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">0580064358800001</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">korusigorta@hs03.kep.tr</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/property-139-magdeburger_130f1.svg"
                                alt="MAGDEBURGER SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/property-139-magdeburger_130f1.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">MAGDEBURGER SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">MAGDEBURGER SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Torun Center, Fulya Mahallesi, Büyükdere Cad. No: 74/D Şişli / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">879001886900017</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">magdeburgersigorta@hs02.kep.tr</span>
                        </div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Mapfre-Sigorta_ee974.svg"
                                alt="MAPFRE GENEL SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Mapfre-Sigorta_ee974.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">MAPFRE GENEL SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">MAPFRE GLOBAL SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Torun Center, Fulya Mahallesi, Büyükdere Cad. No: 74/D Şişli / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">879001886900017</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">mapfresigorta@hs02.kep.tr</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/neova-logo_b528d.svg"
                                alt="NEOVA SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/neova-logo_b528d.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">NEOVA SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">NEOVA SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Kozyatağı E-5 Yan Yol Üzeri Şaşmaz Plaza No:6 Kat 3-5 34742 Kadıköy / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">455033186300019</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">neovasigorta@hs03.kep.tr</span></div>
                       </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/NN-Sigorta_6765b.svg"
                                alt="NN HAYAT VE EMEKLİLİK"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/NN-Sigorta_6765b.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">NN HAYAT VE EMEKLİLİK</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">NN HAYAT VE EMEKLİLİK A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Maslak Mah.&nbsp;Sümer Sok. Maslak Office Building&nbsp;No:4/92, 34485&nbsp; Sarıyer / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">4288961227331600</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span
                                class="typography css-1yykyoh">nnhayatemeklilik.muh@hs03.kep.tr</span></div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Orient-Sigorta_7b153.svg"
                                alt="ORİENT SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Orient-Sigorta_7b153.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ORİENT SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">ORİENT SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Değirmen sokak, No:18 Nida Kule Kat:4 Kozyatağı / Kadıköy / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">647034560000016</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">orientsgorta@hs03.kep.tr</span></div>
                       </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/property-126-prive_69026.png"
                                alt="PRİVE SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/property-126-prive_69026.png">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">PRİVE SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">PRİVE SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Fulya Mahallesi, Büyükdere Cd. Torun Center D Blok No: 74, Kat: 12, 34394 Şişli/İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">-</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">-</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Quick-Sigorta_3aaea.svg"
                                alt="QUICK SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Quick-Sigorta_3aaea.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">QUICK SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">QUİCK SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Veko Giz Plaza Maslak Meydan Sk. No: 3 Kat: 5 Maslak Sarıyer / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">345024957000010</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">quicksigorta@hs03.kep.tr</span></div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ray-Sigorta_9dc01.svg"
                                alt="RAY SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Ray-Sigorta_9dc01.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">RAY SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">RAY SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Haydar Aliyev Cad. No.28 Tarabya, Sarıyer/İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">734003979800033</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">raysigorta.kvk@hs03.kep.tr</span>
                        </div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Sompo-Japan-Sigorta_f3ac2.svg"
                                alt="SOMPO SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Sompo-Japan-Sigorta_f3ac2.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">SOMPO SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">SOMPO SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Rüzgarlıbahçe Mah. Cumhuriyet Cad. Acarlar İş Merkezi No:10 C Blok 34805 Kavacık / Beykoz / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">387019755300019</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">somposigorta@hs03.kep.tr</span></div>
                       </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Seker-Sigorta_d2c06.svg"
                                alt="ŞEKER SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Seker-Sigorta_d2c06.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ŞEKER SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">ŞEKER SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Büyükdere Caddesi No:171 Metrocity A Blok Kat:2 34394 Levent / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">844001356800010</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">sekersigorta@hs03.kep.tr</span></div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Turk-Nippon-Sigorta_464d1.svg"
                                alt="TÜRK NİPPON SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Turk-Nippon-Sigorta_464d1.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">TÜRK NİPPON SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">TÜRK NİPPON SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Altunizade Mah. Mahir İz Cad. No:24 Üsküdar / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">876004899300015</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">turknippon@hs03.kep.tr</span></div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/turkiye-katilim-logo_ef1fd.svg"
                                alt="Türkiye Katılım Sigorta"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/turkiye-katilim-logo_ef1fd.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">Türkiye Katılım Sigorta</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">Türkiye Katılım Sigorta A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">İnkılap Mahallesi, Dr. Adnan Büyükdeniz Caddesi., Akkom Ofis Park Kelif Plaza, No:2, Kat:16-17, 34768, Ümraniye/İstanbul</span>
                        </div>
                        </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Turkiye-Sigorta_5b9d2.svg"
                                alt="TÜRKİYE SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Turkiye-Sigorta_5b9d2.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">TÜRKİYE SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">TÜRKİYE SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Büyükdere Cad. Güneş Plaza No:110 34394 Esentepe / Şişli / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">434005698400014</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">turkiyesigorta@hs02.kep.tr</span>
                        </div>
                         </div></div>
                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Unico-Sigorta_5fdf7.svg"
                                alt="UNICO SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/Unico-Sigorta_5fdf7.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">UNICO SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">UNİCO SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Nidakule Göztepe İş Merkezi Merdivenköy Mahallesi Bora Sokak No:1 Kat: 22-24 Kadıköy / İstanbul</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">211006067500019</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">unicosigorta@hs02.kep.tr</span></div>
                        </div></div>




                     <div class="col-lg-4 col-md-6 mt-5">
                        <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4"
                        style="height: 300px;">
                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle mb-4"
                            style="width: 100px; height: 100px;"><img
                                src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/105x50px_9445e.svg"
                                alt="ZURICH SİGORTA"
                                data-src="https://cdn.dijipol.com/images/dijipolcom/insurancefirm/105x50px_9445e.svg">
                        </div>
                        <h3 class="typography contractedCompaniesCard__title css-gfhva0">ZURICH SİGORTA</h3>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Ünvan : </b>  </label><span class="typography css-1yykyoh">ZURİCH SİGORTA A.Ş.</span>
                        </div>
                        <div class="contractedCompaniesCard-item"><label
                                class="typography css-1ebooff"><b>Adres : </b><span class="typography css-1yykyoh">Orjin Maslak İş Merkezi, Eski Büyükdere Cad. No: 27 Kat: 12-13 PK: 34485 Sarıyer / İstanbul
</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Mersis
                                No</label><span class="typography css-1yykyoh">833007681100018</span></div>
                        <div class="contractedCompaniesCard-item"><label class="typography css-1ebooff">Kep
                                <b>Adres : </b><span class="typography css-1yykyoh">zurichsigorta@hs02.kep.tr</span></div>
                        </div></div>




            </div>
        </div>
    </div>

@endsection



@section('scripts')
    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{asset('backend')}}/assets/js/vendor.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            input = document.getElementById("phone");

            Inputmask("+90 999 999 99 99").mask(input);
            if (input.value.trim() === "") {
                input.value = "+90 ";
            }
        });
    </script>
    <script>


        // CSRF Token ayarı
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Telefon numarası değiştiğinde müşteri arama
        $('#phone').on('change', function() {
            var phone = $(this).val();
            if (phone.length >= 10) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("admin.customers.search") }}',
                    data: {
                        phone: phone,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            if (response.customer) {
                                // Müşteri bulundu, form alanlarını doldur
                                $('#name').val(response.customer.name);
                                $('#email').val(response.customer.email);
                                $('#city').val(response.customer.city);
                                $('#customer-search-result').html('<div class="alert alert-success">Müşteri bulundu: ' + response.customer.name + '</div>');
                            } else {
                                // Müşteri bulunamadı, yeni müşteri ekleme seçeneği sun
                                $('#customer-search-result').html('<div class="alert alert-info">Bu telefon numarasına sahip müşteri bulunamadı. Yeni müşteri olarak devam edebilirsiniz.</div>');
                            }
                        } else {
                            $('#customer-search-result').html('<div class="alert alert-danger">Bir hata oluştu: ' + response.message + '</div>');
                        }
                    },
                    error: function(xhr) {
                        $('#customer-search-result').html('<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>');
                    }
                });
            }
        });

        let daskFormSelector = '#dask-address-code-calculate';

        $('.uavt-form-button').on('click', function (e) {
            e.preventDefault();

            // Form verilerini al
            let formData = $(daskFormSelector).serialize();

            // CSRF token'ı ekle
            formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: '{{ route("dask.address.code.calculate.response") }}',
                headers: {
                    'Origin': 'referanssigorta.net',
                    'Referer': 'referanssigorta.net',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log('success');
                    console.log(response);
                    let data = response.response;

                    if (data != null) {
                        if (data.ApartmentsNo == undefined) {
                            var apartmentsNo = ' ';
                        } else {
                            var apartmentsNo = ' / ' + data.ApartmentsNo;
                        }

                    } else {
                        let address = 'Maalesef Sonuç Bulunamadı.';
                    }





                },
                error: function (response) {
                    alert(response.message);
                }
            });


        });

        $('#daire_no').on('change',function (options){
            $('#uavt-kodu-response').text($('#daire_no').val());
            let address = '';
            address += $('#mahalle option:selected').text()+ ' Mah. ';
            address += ' '+ $('#sokak option:selected').text();
            address +='No: '+ $('#door_no option:selected').text();
            address +=' / '+ $('#daire_no option:selected').text();
            address +=' '+ $('#ilce option:selected').text();
            address += ' / '+$('#il-secim option:selected').text();

            $('#uavt-adress-response').text(address);
        })

        $('.dask-address-code').change(function () {
            var url = $(this).data('url');
            var status = $(this).data('status');
            var value = $(this).val();
            var nextSelectorName = $(this).data('next-name');
            var prevSelectorName = $(this).data('prev-name');
            var prevSelectorValue = $('select[name="' + prevSelectorName + '"]').val();

            $(this).closest('.col-md-12').nextAll('.col-md-6').find('select option').html('<option value="">Seçiniz</option>');
            $(this).closest('.col-md-6').nextAll('.col-md-6').find('select option').html('<option value="">Seçiniz</option>');

            $('select[name="' + nextSelectorName + '"]').html('<option value="">Yükleniyor...</option>');

            var data = {

                value: value,
                status: status,
                prevSelectorValue: prevSelectorValue
            };
            $.ajax({
                type: "POST",
                url: '{{ route("dask.address.code.calculate") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                dataType: "json",
                success: function (response) {
                    if (!jQuery.isEmptyObject(response)) {
                        $('select[name="' + nextSelectorName + '"]').html('<option value="">Seçiniz</option>');
                        let data = response.response;

                        if (data.length > 1) {
                            $.each(data, function (key, value) {
                                selectorAddDask(nextSelectorName, value, status)
                            });
                        } else {
                            selectorAddDask(nextSelectorName, data, status);
                        }

                    }
                },
                error: function (response) {
                    alert(response.responseJSON.message);
                    $('select[name="' + nextSelectorName + '"]').html('<option value="">Bulunamadı...</option>');
                }
            });
        });

        function selectorAddDask(nextSelectorName, data, status) {
            if (status == 1) {
                var optionValue = data.DISTRICTVALUECODE;
                var optionName = data.DISTRICTVALUENAME;
            } else if (status == 2) {
                var optionValue = data.TOWNCODE;
                var optionName = data.TOWNNAME;
            } else if (status == 3) {
                var optionValue = data.TOWNCODE;
                var optionName = data.TOWNNAME;
            } else if (status == 4) {
                var optionValue = data.STREETCODE;
                var optionName = data.STREETNAME;
            } else if (status == 5) {
                var optionValue = data.BUILDINGCODE;
                var optionName = data.BUILDINGNAME;
            } else if (status == 6) {
                var optionValue = data.FLOORCODE;
                var optionName = data.FLOORNAME;

            }

            $('select[name="' + nextSelectorName + '"]').append('<option value="' + optionValue + '">' + optionName + '</option>');
        }


        function formResponseTrue(number, content, status) {
            let formResponseSelector = '#form-response';

            if (status == 1) {
                $(formResponseSelector + ' .image').remove();
                $(formResponseSelector + ' .number').remove();
                $(formResponseSelector + ' .content').addClass('col-12');
                $(formResponseSelector + ' .content').removeClass('col-md-6');
                $(formResponseSelector + ' .content').html(content);
            } else if (status == 2) {
                $(formResponseSelector + ' .image').remove();
                $(formResponseSelector + ' .number').removeClass('d-none');
                $(formResponseSelector + ' .content').removeClass('col-md-12');
                $(formResponseSelector + ' .content').addClass('col-md-6');
                $(formResponseSelector + ' .content').html(content);
                $(formResponseSelector + ' .number').html(number);
            } else if (status == 3) {
                $(formResponseSelector + ' .image').remove();
                $(formResponseSelector + ' .number').addClass('d-none');
                $(formResponseSelector + ' .content').addClass('col-md-12');
                $(formResponseSelector + ' .content').removeClass('col-md-6');
                $(formResponseSelector + ' .content').html(content);
            } else {
                $(formResponseSelector + ' .number').html(number);
                $(formResponseSelector + ' .content').html(content);
            }

            $(formResponseSelector).fadeIn('500');

        }


    </script>

@endsection
