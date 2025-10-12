@extends('backend.layout.layout')

@section('title', 'Teklifleriniz - Nice Yazılım')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Tekliflerim</h4>
                        <p class="text-muted mb-0">Çeşitli firmalardan alınan tekliflere buradan erişebilirsiniz</p>
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-green btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addModal"> Tema Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="offer_requests" :columns="['#','Firma Adı','Müşteri Adı','Durum','İşlemler']">
                        @foreach($items as $item)
                            <tr class="align-middle">
                                <td class="text-center">{{ $item->id }}</td>

                                <td> {{ $item->getDomain?->getDealer?->name }} </td>
                                <td>{{ $item->getDealerCustomer?->name }}</td>

                                <td>
                                    {!!   $item->is_completed ? '<span class="badge bg-success">Tamamlandı</span>' : '<span class="badge bg-warning">Devam Ediyor</span>' !!}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary width-xs">İşlemler</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">

                                            <li><a class="dropdown-item" href="{{route('admin.teklif-al.live.watch', $item->id)}}">Canlı İzle</a></li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                    {{$items->links('vendor.pagination.bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('#themes').DataTable({
                "language": {
                    "url": "{{asset('backend/assets/js/Turkish.json')}}"
                },
                "columnDefs": [
                    {
                        "width": "10%",
                        "targets": 3
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
