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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                @foreach($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{!! $item->html_image !!}</td>
                                    <td>{!! $item->html_status !!}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @foreach($model->buttons as $button)
                                                @if($button == 'edit')
                                                    <button type="button"
                                                            class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $item->id }}">
                                                        <iconify-icon icon="material-symbols:edit"></iconify-icon>
                                                    </button>
                                                @endif
                                                @if($button == 'delete')
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $item->id }}">
                                                        <iconify-icon icon="material-symbols:delete"></iconify-icon>
                                                    </button>
                                                @endif
                                                @if($button == 'show')
                                                    <button type="button"
                                                            class="btn btn-info btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showModal{{ $item->id }}">
                                                        <iconify-icon icon="material-symbols:visibility"></iconify-icon>
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($items as $item)
        @include('backend.slider.modals.edit', ['item' => $item])
        @include('backend.slider.modals.delete', ['item' => $item])
        @include('backend.slider.modals.show', ['item' => $item])
    @endforeach

    @include('backend.slider.modals.create')
@endsection 