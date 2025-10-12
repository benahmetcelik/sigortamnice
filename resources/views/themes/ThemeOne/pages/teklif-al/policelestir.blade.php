@extends('themes.ThemeOne.layouts.app')



@section('content')

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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#uavtModal">
                                <i class="fas fa-search me-1"></i> UAVT Kodu Bul
                            </button>
                        </div>
                        <div class="card-body">


                            <form action="{{ route('dask.store') }}" method="POST" class="contact-form">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="PolicyNumber" class="form-label">Poliçe NO</label>
                                            <input type="text" class="form-control" id="PolicyNumber" name="PolicyNumber"
                                                   value="{{ $offer->getFieldFromService('PolicyNumber') }}" readonly required>
                                            @error('PolicyNumber')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Soyad</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                   value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">E-posta</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="{{  old('email') }}" required>
                                            @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_no" class="form-label">Tc / Pasaport No</label>
                                            <input type="text" class="form-control" id="passport_no" name="passport_no"
                                                   value="{{  old('passport_no') }}" required>
                                            @error('passport_no')
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
                                            <input type="text" class="form-control" id="city" name="city"
                                                   value="{{ old('city') }}" required>
                                            @error('city')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="building_type" class="form-label">Bina Tipi</label>
                                            <select class="form-control form-select contact-form" id="building_type"
                                                    name="building_type" required>
                                                <option value="">Seçiniz</option>
                                                <option
                                                    value="apartment" {{ old('building_type') == 'apartment' ? 'selected' : '' }}>
                                                    Apartman Dairesi
                                                </option>
                                                <option
                                                    value="house" {{ old('building_type') == 'house' ? 'selected' : '' }}>
                                                    Müstakil Ev
                                                </option>
                                                <option
                                                    value="villa" {{ old('building_type') == 'villa' ? 'selected' : '' }}>
                                                    Villa
                                                </option>
                                            </select>
                                            @error('building_type')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="building_age" class="form-label">Bina İnşaa Yılı</label>
                                            <input type="number" class="form-control" id="building_age"
                                                   name="building_age" value="{{ old('building_age') }}" required>
                                            @error('building_age')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="building_size" class="form-label">Bina Büyüklüğü (m²)</label>
                                            <input type="number" class="form-control" id="building_size"
                                                   name="building_size" value="{{ old('building_size') }}" required>
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
                                            <input type="text" class="form-control" id="uavt_code" name="uavt_code"
                                                   value="{{ old('uavt_code') }}" required>
                                            @error('uavt_code')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="building_usage" class="form-label">Bina Kullanım Amacı</label>
                                            <select class=" form-control form-select" id="building_usage"
                                                    name="building_usage" required>
                                                <option value="">Seçiniz</option>
                                                <option
                                                    value="MESKEN" {{ old('building_usage') == 'MESKEN' ? 'selected' : '' }}>
                                                    Mesken
                                                </option>
                                                <option
                                                    value="TİCARETHANE" {{ old('building_usage') == 'TİCARETHANE' ? 'selected' : '' }}>
                                                    Ticarethane
                                                </option>
                                                <option
                                                    value="DİĞER" {{ old('building_usage') == 'DİĞER' ? 'selected' : '' }}>
                                                    Diğer
                                                </option>
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
                                            <input type="number" class="form-control" id="building_floor"
                                                   name="building_floor" value="{{ old('building_floor') }}" required>
                                            @error('building_floor')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="total_floors" class="form-label">Toplam Kat Sayısı</label>
                                            <input type="number" class="form-control" id="total_floors"
                                                   name="total_floors" value="{{ old('total_floors') }}" required>
                                            @error('total_floors')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="building_material" class="form-label">Bina Yapı
                                                Malzemesi</label>
                                            <select class="form-control form-select" id="building_material"
                                                    name="building_material" required>
                                                <option value="">Seçiniz</option>
                                                <option
                                                    value="Çelik, betonarme" {{ old('building_material') == 'Çelik, betonarme' ? 'selected' : '' }}>
                                                    Çelik, Betonarme
                                                </option>
                                                <option
                                                    value="Diğer" {{ old('building_material') == 'Diğer' ? 'selected' : '' }}>
                                                    Diğer
                                                </option>
                                            </select>
                                            @error('building_material')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="building_risk_class" class="form-label">Bina Risk Sınıfı</label>
                                            <select class="form-control form-select" id="building_risk_class"
                                                    name="building_risk_class" required>
                                                <option value="">Seçiniz</option>
                                                <option
                                                    value="1" {{ old('building_risk_class') == '1' ? 'selected' : '' }}>
                                                    1. Sınıf
                                                </option>
                                                <option
                                                    value="2" {{ old('building_risk_class') == '2' ? 'selected' : '' }}>
                                                    2. Sınıf
                                                </option>
                                                <option
                                                    value="3" {{ old('building_risk_class') == '3' ? 'selected' : '' }}>
                                                    3. Sınıf
                                                </option>
                                                <option
                                                    value="4" {{ old('building_risk_class') == '4' ? 'selected' : '' }}>
                                                    4. Sınıf
                                                </option>
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
                                            <label for="address" class="form-label">Adres</label>
                                            <textarea class="form-control" id="address" name="address"
                                                      rows="3">{{ old('address') }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="additional_info" class="form-label">Ek Bilgiler</label>
                                            <textarea class="form-control" id="additional_info" name="additional_info"
                                                      rows="3">{{ old('additional_info') }}</textarea>
                                            @error('additional_info')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('admin.teklif-al.index') }}"
                                       class="btn btn-secondary me-2">İptal</a>
                                    <button type="submit" class="btn btn-primary">Teklif Al</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



@section('scripts')
    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{asset('backend')}}/assets/js/vendor.js"></script>
    <script src="{{asset('/')}}/ililce.js?v=1.50.3"></script>

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
        $('#phone').on('change', function () {
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
                    success: function (response) {
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
                    error: function (xhr) {
                        $('#customer-search-result').html('<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>');
                    }
                });
            }
        });


    </script>



    <script>

        $(document).ready(function () {

            loadUavtIlList();
        });

        var islem = "";
        var els = ['uavt_city', 'uavt_ilce', 'bucak', 'mahalle', 'sokak', 'bina', 'daire'];

        function getData(id, process) {
            islem = process;



            $.ajax({
                type: "POST",
                url: '{{ route("dask.address.code.calculate") }}',
                data: {
                    search_type: process,
                    _token: '{{ csrf_token() }}',
                    search_value: id
                },
                dataType: "json",
                success: function (response) {

                    let $select = $('#'+process);

                    // önce select'i temizle (opsiyonel)
                    $select.empty();

                    // istersen ilk option'u tekrar ekleyebilirsin
                    $select.append('<option value="">Lütfen Seçin</option>');

                    // data'yı dönerek option ekle
                    $.each(response.Data, function(index, item) {
                        if (process === 'bina'){
                            $select.append(
                                $('<option>', {
                                    value: item.Kod,
                                    text: item.BinaNo
                                })
                            );
                        }else if(process === 'daire'){
                            $select.append(
                                $('<option>', {
                                    value: item.UAVT,
                                    text: item.DaireNo
                                })
                            );
                        }else{
                            $select.append(
                                $('<option>', {
                                    value: item.kod,
                                    text: item.ad + (item.hasOwnProperty('CSBMAd') ? item.CSBMAd : '')
                                })
                            );
                        }

                    });
                },
                error: function (xhr) {
                    $('#customer-search-result').html('<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>');
                }
            });


            console.log(id)
            console.log(process)
            islem = process;

        }

        function handleUavtData(res) {
            loadUavtData(res.Data, islem);
        }

        function loadUavtData(data, el) {
            $("#" + el).html('');
            for (let i = 0; i < data.length; i++) {
                let item = data[i];
                let code = getOption(item, el);
                $("#" + el).append(code);
            }

            refreshUavtElement(el);
        }



        function getOption(item, el) {
            let title = "";
            switch (el) {
                case "bucak":
                    return '<option value="' + item.kod + '">' + item.ad + '</option>';

                case "bina":
                    title = (item.BinaAd) ? item.BinaAd + " " + item.BinaNo : item.BinaNo;
                    return '<option value="' + item.Kod + '">' + title + ' - ' + item.Kod + '</option>';

                case "daire":
                    title = (item.DaireNo) ? item.DaireNo : "---"
                    return '<option value="' + item.UAVT + '">' + title + '</option>';

                default:
                    return '<option value="' + item.kod + '">' + item.ad + '</option>';
            }
        }

        function clearCombos(el) {
            let start = 0;
            for (let i = 0; i < els.length; i++) {
                if (els[i] === el) {
                    start = i;
                }
            }
            console.log(start);
            for (let a = 0; a < els.length; a++) {
                if (a >= start) {
                    let element = els[a];
                    console.log(a + " - " + element);
                    $("#" + element).html("");

                }
            }
            $("#uavtKodu").html('');
        }

        function hesapla() {
            let val = $("#daire").val();
            if (val === '') return;
            $("#uavtKodu").html(val);
        }


        function loadUavtIlList() {
            loadCities();
        }




        function handleUavtIlList(res) {
            $("#uavt_city").html('');
            for (let i = 0; i < res.Data.length; i++) {
                let item = res.Data[i];
                let code = '<option value="' + item.kod + '">' + item.ad + '</option>';
                $("#uavt_city").append(code);
            }

            refreshUavtElement("uavt_city");
        }
    </script>

@endsection
