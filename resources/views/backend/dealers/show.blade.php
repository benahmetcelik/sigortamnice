@extends('backend.layout.layout')

@section('title', 'Bayi Detayları - Nice Yazılım')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Bayi Detayları</h6>
                        <div>
                            <a href="{{ route('admin.dealers.edit', $dealer) }}" class="btn btn-primary btn-sm">Düzenle</a>
                            <a href="{{ route('admin.dealers.index') }}" class="btn btn-secondary btn-sm">Geri Dön</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Bayi Adı</label>
                                        <p class="form-control-static">{{ $dealer->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">E-posta</label>
                                        <p class="form-control-static">{{ $dealer->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Telefon</label>
                                        <p class="form-control-static">{{ $dealer->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Şehir</label>
                                        <p class="form-control-static">{{ $dealer->city ?? 'Belirtilmemiş' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Adres</label>
                                        <p class="form-control-static">{{ $dealer->address ?? 'Belirtilmemiş' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Durum</label>
                                        <p class="form-control-static">
                                            @if($dealer->status == 'active')
                                                <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">Pasif</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Oluşturulma Tarihi</label>
                                        <p class="form-control-static">{{ $dealer->created_at->format('d.m.Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Güncellenme Tarihi</label>
                                        <p class="form-control-static">{{ $dealer->updated_at->format('d.m.Y H:i') }}</p>
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
