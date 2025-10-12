@extends('backend.layout.layout')

@section('title', 'Bayi Yönetimi')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Bayi Listesi</h4>
                        <p class="text-muted mb-0">Bayilerinizi bu tablodan yönetebilirsiniz.</p>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('admin.dealers.create') }}" class="btn btn-green btn-sm d-flex align-items-center justify-content-center">
                            Yeni Bayi Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="dealers" :columns="['#','Bayi Adı','E-posta','Telefon','Şehir','Durum','İşlemler']">
                        @foreach($dealers as $dealer)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $dealer->name }}</td>
                                <td>{{ $dealer->email }}</td>
                                <td>{{ $dealer->phone }}</td>
                                <td>{{ $dealer->city }}</td>
                                <td>
                                    {!! $dealer->status == 'active' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>' !!}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary width-xs">İşlemler</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.dealers.edit', $dealer->id) }}">Düzenle</a></li>
                                            <li>
                                                <form action="{{ route('admin.dealers.destroy', $dealer->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Bu bayiyi silmek istediğinize emin misiniz?')">Sil</button>
                                                </form>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('admin.customers.index', ['dealer_id' => $dealer->id]) }}">Müşterileri Görüntüle</a></li>
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
    <script>
        $(document).ready(function() {
            $('#dealers').DataTable({
                "language": {
                    "url": "{{asset('backend/assets/js/Turkish.json')}}"
                },
                "columnDefs": [
                    {
                        "width": "10%",
                        "targets": 5
                    },
                    {
                        "width": "5%",
                        "targets": 0,
                    },
                ]
            });
        });
    </script>
@endsection
