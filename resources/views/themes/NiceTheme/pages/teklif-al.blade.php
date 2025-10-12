@extends('themes.NiceTheme.layouts.app')

@section('title', 'Anasayfa - Nice Yazılım')

@section('content')
    <style>
        /*DEMO ONLY*/

        .service-categories {
            padding-top: 3em;
            padding-bottom: 3em;
            background-size: cover;
        }


        /*DEMO ONLY*/

        .service-categories .card {
            transition: all 0.3s;
        }

        .service-categories .card-title {
            padding-top: 0.5em;
        }

        .service-categories a:hover {
            text-decoration: none;
        }

        .service-card {
            background: #5d727c;
            border: 0;
        }

        .service-card:hover {
            background: rgba(72, 88, 104, 1);
            box-shadow: 2px 4px 8px 0px rgba(46, 61, 73, 0.2)
        }

        .fa {
            color: white;
        }
    </style>

    <section class="service-categories text-xs-center">
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse">
                            <div class="card-block">
                                <span class="fa fa-lightbulb-o fa-3x"></span>
                                <h4 class="card-title">Creative</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse">
                            <div class="card-block">
                                <span class="fa fa-bolt fa-3x"></span>
                                <h4 class="card-title">Energetic</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse">
                            <div class="card-block">
                                <span class="fa fa-eye fa-3x"></span>
                                <h4 class="card-title">Focused</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse">
                            <div class="card-block">
                                <span class="fa fa-cutlery fa-3x"></span>
                                <h4 class="card-title">Hungry</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse">
                            <div class="card-block">
                                <span class="fa fa-heart fa-3x"></span>
                                <h4 class="card-title">Intimate</h4>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse ">
                            <div class="card-block">
                                <span class="fa fa-cloud fa-3x"></span>
                                <h4 class="card-title">Relaxed</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse">
                            <div class="card-block">
                                <span class="fa fa-bed fa-3x"></span>
                                <h4 class="card-title">Sleepy</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="card service-card card-inverse">
                            <div class="card-block">
                                <span class="fa fa-smile-o fa-3x"></span>
                                <h4 class="card-title">Uplifted</h4>
                            </div>
                        </div>
                    </a>
                </div>


            </div>
            <!--End Row-->

        </div>
    </section>


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

        $('#daire_no').on('change', function (options) {
            $('#uavt-kodu-response').text($('#daire_no').val());
            let address = '';
            address += $('#mahalle option:selected').text() + ' Mah. ';
            address += ' ' + $('#sokak option:selected').text();
            address += 'No: ' + $('#door_no option:selected').text();
            address += ' / ' + $('#daire_no option:selected').text();
            address += ' ' + $('#ilce option:selected').text();
            address += ' / ' + $('#il-secim option:selected').text();

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
