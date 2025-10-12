@extends('backend.layout.layout')

@section('title', 'Müşteri Yönetimi')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Müşteri Listesi</h4>
                        <p class="text-muted mb-0">Müşterilerinizi bu tablodan yönetebilirsiniz.</p>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('admin.customers.create') }}" class="btn btn-green btn-sm d-flex align-items-center justify-content-center">
                            Yeni Müşteri Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="customers" :columns="['#','Müşteri Adı','TC No','E-posta','Telefon','Şehir','Bayi','Durum','İşlemler']">
                        @foreach($customers as $customer)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->tc_no }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->city }}</td>
                                <td>{{ $customer->dealer->name }}</td>
                                <td>
                                    {!! $customer->status == 'active' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>' !!}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary width-xs">İşlemler</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.customers.edit', $customer->id) }}">Düzenle</a></li>
                                            <li>
                                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Bu müşteriyi silmek istediğinize emin misiniz?')">Sil</button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.teklif-al.create', ['customer_id' => $customer->id]) }}">Teklif Al</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


@endsection
