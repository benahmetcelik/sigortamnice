@extends('backend.layout.layout')
@section('title', 'Kasko Teklifi Oluştur')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Kasko Teklifi Oluştur</h4>
                        <p class="text-muted mb-0">Kasko sigortası teklifi için gerekli bilgileri girin</p>
                    </div>
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

                    <form action="{{ route('admin.teklif-al.kasko.store') }}" method="POST">
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
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer ? $customer->phone : old('phone') }}" required>
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="plate" class="form-label">Plaka</label>
                                    <input type="text" class="form-control" id="plate" name="plate" value="{{ old('plate') }}" required>
                                    @error('plate')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Marka</label>
                                    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}" required>
                                    @error('brand')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" required>
                                    @error('model')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Yıl</label>
                                    <input type="number" class="form-control" id="year" name="year" value="{{ old('year') }}" required>
                                    @error('year')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="engine_no" class="form-label">Motor No</label>
                                    <input type="text" class="form-control" id="engine_no" name="engine_no" value="{{ old('engine_no') }}" required>
                                    @error('engine_no')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="chassis_no" class="form-label">Şasi No</label>
                                    <input type="text" class="form-control" id="chassis_no" name="chassis_no" value="{{ old('chassis_no') }}" required>
                                    @error('chassis_no')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="insurance_company" class="form-label">Mevcut Sigorta Şirketi</label>
                                    <input type="text" class="form-control" id="insurance_company" name="insurance_company" value="{{ old('insurance_company') }}">
                                    @error('insurance_company')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="policy_number" class="form-label">Poliçe Numarası</label>
                                    <input type="text" class="form-control" id="policy_number" name="policy_number" value="{{ old('policy_number') }}">
                                    @error('policy_number')
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
@endsection

@section('scripts')
@endsection
