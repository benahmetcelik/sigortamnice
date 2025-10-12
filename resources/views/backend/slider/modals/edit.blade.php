<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">{{ __('models.'.$model->getModelName().'.singular') }} Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route($routeBase.'update', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        @foreach($model->getInputs() as $key => $input)
                            <div class="col-md-6 mb-3">
                                <label for="{{ $key }}" class="form-label">{{ __('models.'.$model->getModelName().'.fields.'.$key) }}</label>
                                @if($input == 'text')
                                    <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ $item->{$key} }}" required>
                                @elseif($input == 'textarea')
                                    <textarea class="form-control" id="{{ $key }}" name="{{ $key }}" rows="3" required>{{ $item->{$key} }}</textarea>
                                @elseif($input == 'file')
                                    <input type="file" class="form-control" id="{{ $key }}" name="{{ $key }}">
                                    @if($item->{$key})
                                        <img src="{{ asset($item->{$key}) }}" alt="{{ $item->title }}" class="img-thumbnail mt-2" width="100">
                                    @endif
                                @elseif($input == 'number')
                                    <input type="number" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ $item->{$key} }}" required>
                                @elseif(is_array($input))
                                    <select class="form-select" id="{{ $key }}" name="{{ $key }}" required>
                                        <option value="">Seçiniz</option>
                                        @foreach($input as $value => $label)
                                            <option value="{{ $value }}" {{ $item->{$key} == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div> 