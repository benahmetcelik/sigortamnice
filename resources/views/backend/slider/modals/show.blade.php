<div class="modal fade" id="showModal{{ $item->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $item->id }}">{{ __('models.'.$model->getModelName().'.singular') }} Detay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($model->getInputs() as $key => $input)
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">{{ __('models.'.$model->getModelName().'.fields.'.$key) }}</label>
                            @if($input == 'file')
                                @if($item->{$key})
                                    <img src="{{ asset($item->{$key}) }}" alt="{{ $item->title }}" class="img-thumbnail" width="200">
                                @else
                                    <p class="text-muted">Görsel yok</p>
                                @endif
                            @elseif(is_array($input))
                                <p>{{ $input[$item->{$key}] ?? $item->{$key} }}</p>
                            @else
                                <p>{{ $item->{$key} }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div> 