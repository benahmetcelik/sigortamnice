@extends('backend.layout.layout')
@section('title', __('models.'.$model->getModelName().'.singular'))

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">{{ __('models.'.$model->getModelName().'.singular') }}</h4>
                        <p class="text-muted mb-0">{{ __('models.'.$model->getModelName().'.pluroal') }}
                            buradan seçebilir ve aktifleştirebilirsiniz</p>
                    </div>
                    <div class="d-flex">
                        <button type="button"
                                class="btn btn-green btn-sm d-flex align-items-center justify-content-center"
                                data-bs-toggle="modal"
                                data-bs-target="#addModal"> {{ __('models.'.$model->getModelName().'.singular') }}
                            Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
                @php($columns = array_merge(['#'],array_values(($model->getTableHeaders()))))

                <div class="card-body">
                    <x-data-table id="blog" :columns="$columns">
                        @foreach($items ?? [] as $item)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                @foreach(array_keys($model->getTableHeaders()) as $key)
                                    @if($key == 'actions')
                                        @continue
                                    @endif
                                    <td>{!! $item->{$key} !!}</td>
                                @endforeach
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary width-xs">İşlemler</button>
                                        <button type="button"
                                                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            @if($model->getModelName() == 'theme' && $item->id != request()->theme_id )
                                                <li><a class="dropdown-item"
                                                       href="{{route('admin.themes.select', $item->id)}}">Seç</a></li>
                                            @endif
                                            @foreach($model->getButtons($item->id) as $button)
                                                <li>{!! $button !!}  </li>
                                                @if($button == 'edit')


                                                @endif
                                                @if($button == 'del')
                                                    <li><a class="dropdown-item"
                                                           href="{{route('admin.themes.select', $item->id)}}">Seç</a>
                                                    </li>
                                                @endif
                                                @if($button == 'show')
                                                    <li><a class="dropdown-item"
                                                           href="{{route('admin.themes.select', $item->id)}}">Seç</a>
                                                    </li>
                                                @endif
                                            @endforeach

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
        $(document).ready(function () {
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
