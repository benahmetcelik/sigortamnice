<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">{{ __('models.'.$model->getModelName().'.singular') }} Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route($routeBase.'store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @foreach($model->getInputs() as $key => $input)
                            <div class="col-md-6 mb-3">
                                <label for="{{ $key }}" class="form-label">{{ __('models.'.$model->getModelName().'.fields.'.$key) }}</label>
                                @if($input == 'text')
                                    <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" required>
                                @elseif($input == 'textarea')
                                    <textarea class="form-control" id="{{ $key }}" name="{{ $key }}" rows="3" required></textarea>
                                @elseif($input == 'file')
                                    <input type="file" class="form-control" id="{{ $key }}" name="{{ $key }}" required>
                                @elseif($input == 'number')
                                    <input type="number" class="form-control" id="{{ $key }}" name="{{ $key }}" required>
                                @elseif(is_array($input))
                                    <select class="form-select" id="{{ $key }}" name="{{ $key }}" required>
                                        <option value="">Seçiniz</option>
                                        @foreach($input as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div> 