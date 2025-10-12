@extends('backend.layout.layout')
@section('title', 'Temalar')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Temalar</h4>
                        <p class="text-muted mb-0">Temalarınızı buradan seçebilir ve aktifleştirebilirsiniz</p>
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-green btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addModal"> Tema Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="blog-comment" :columns="['#','Tema Adı','Önizleme','Durum','İşlemler']">
                        @foreach($items as $item)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td><a href="{{ $item->demo_url }}">
                                        <img src="{{ $item->image }}" alt="" srcset="">
                                    </a> </td>
                                <td>
                                    {!!   $item->id == request()->theme_id ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>' !!}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary width-xs">İşlemler</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            @if($item->id != request()->theme_id )
                                                <li><a class="dropdown-item" href="{{route('admin.themes.select', $item->id)}}">Seç</a></li>
                                            @endif
                                            <li><a class="dropdown-item" href="{{route('admin.themes.select', $item->id)}}">Seç</a></li>

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
            $('#table').DataTable({
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
