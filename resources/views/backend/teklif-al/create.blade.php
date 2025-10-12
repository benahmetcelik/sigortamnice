@extends('backend.layout.layout')
@section('title', 'Teklif Oluştur')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Teklif Oluştur</h4>
                        <p class="text-muted mb-0">Tekliflerinizi türe göre oluşturun</p>
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

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                        <a class="card icon-box" href="{{ route('admin.teklif-al.dask', ['customer_id' => $customer ? $customer->id : null]) }}">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <iconify-icon icon="solar:home-bold" class="fs-2 text-primary"></iconify-icon>
                                <h5 class="mt-2 mb-0">Dask</h5>
                            </div>
                        </a>

                        <a class="card icon-box" href="{{ route('admin.teklif-al.traffic', ['customer_id' => $customer ? $customer->id : null]) }}">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <iconify-icon icon="solar:bus-bold-duotone" class="fs-2 text-green"></iconify-icon>
                                <h5 class="mt-2 mb-0">Trafik Sigortası</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
