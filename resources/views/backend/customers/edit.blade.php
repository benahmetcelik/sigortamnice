@extends('backend.layout.layout')

@section('title', 'Müşteri Düzenle - Nice Yazılım')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Müşteri Düzenle</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dealer_id" class="form-control-label">Bayi</label>
                                        <select class="form-control @error('dealer_id') is-invalid @enderror" id="dealer_id" name="dealer_id" required>
                                            <option value="">Bayi Seçin</option>
                                            @foreach($dealers as $dealer)
                                                <option value="{{ $dealer->id }}" {{ old('dealer_id', $customer->dealer_id) == $dealer->id ? 'selected' : '' }}>
                                                    {{ $dealer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dealer_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Müşteri Adı</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">E-posta</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">Telefon</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city" class="form-control-label">Şehir</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $customer->city) }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">Durum</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="active" {{ old('status', $customer->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                            <option value="passive" {{ old('status', $customer->status) == 'passive' ? 'selected' : '' }}>Pasif</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tc_no" class="form-control-label">TC Kimlik No</label>
                                        <input type="text" class="form-control @error('tc_no') is-invalid @enderror" id="tc_no" name="tc_no" value="{{ old('tc_no', $customer->tc_no) }}" maxlength="11" pattern="[0-9]{11}">
                                        @error('tc_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">Adres</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address', $customer->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">İptal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
