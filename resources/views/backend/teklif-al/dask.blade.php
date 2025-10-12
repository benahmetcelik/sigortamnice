@extends('backend.layout.layout')

@section('title', 'DASK Teklifi Oluştur')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">DASK Teklifi Oluştur</h4>
                        <p class="text-muted mb-0">DASK sigortası teklifi için gerekli bilgileri girin</p>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uavtModal">
                        <i class="fas fa-search me-1"></i> UAVT Kodu Bul
                    </button>
                </div>
                <div class="card-body">
                    @if($customer)
                    <div class="alert alert-info">
                        <h5 class="alert-heading">Müşteri Bilgileri</h5>
                        <p class="mb-0">Müşteri: {{ $customer->name }}</p>
                        <p class="mb-0">E-posta: {{ $customer->email }}</p>
                        <p class="mb-0">Telefon: {{ $customer->phone }}</p>
                        <p class="mb-0">Şehir: {{ $customer->city }}</p>
                    </div>
                    @endif

                    <form action="{{ route('admin.teklif-al.dask.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer ? $customer->id : null }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Ad Soyad</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer ? $customer->name : old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-posta</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $customer ? $customer->email : old('email') }}" required>
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
                                           value="{{ $customer ? $customer->phone : old('phone') ?? '+90 ' }}" required>

                                    <div id="customer-search-result" class="mt-2"></div>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Şehir</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $customer ? $customer->city : old('city') }}" required>
                                    @error('city')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Adres</label>
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
                                    <select class="form-select" id="building_type" name="building_type" required>
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
                                    <select class="form-select" id="building_usage" name="building_usage" required>
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
                                    <select class="form-select" id="building_material" name="building_material" required>
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
                                    <select class="form-select" id="building_risk_class" name="building_risk_class" required>
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
@endsection

@section('scripts')
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
