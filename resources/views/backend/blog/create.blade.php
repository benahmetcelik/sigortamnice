@extends('backend.layout.layout')
@section('title', 'Temalar')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">{{ __('models.'.(app()->make($model))->getModelName().'.singular') }}</h4>
                        <p class="text-muted mb-0">{{ __('models.'.(app()->make($model))->getModelName().'.pluroal') }}
                            buradan seçebilir ve aktifleştirebilirsiniz</p>
                    </div>
                    <div class="d-flex">
                        <button type="button"
                                class="btn btn-green btn-sm d-flex align-items-center justify-content-center"
                                data-bs-toggle="modal"
                                data-bs-target="#addModal"> {{ __('models.'.(app()->make($model))->getModelName().'.singular') }}
                            Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    {{ html()->form('POST', route((app()->make($model))->getCreateRoute()))->acceptsFiles()->open() }}
                    @foreach((app()->make($model))->getInputs() as $key=>$value)
                        <div class="mb-3">
                            {{ html()->label(__('inputs.'.$key.'.label'))->class('form-label')->for('form-element-'.$key) }}
                            @if(is_array($value))
                                {{ html()->select($key,$value)->name($key)->addClass('form-control')->placeholder(__('inputs.'.$key.'.placeholder'))->id('form-element-'.$key) }}
                            @else

                                @if(class_exists($value) && $reflection = new ReflectionClass($value))
                                    @if($reflection->isInstantiable())
                                        {{ html()->select($key)->name($key)->options(app()->make($value)->select('id','title')->pluck('title','id'))
->placeholder(__('inputs.'.$key.'.placeholder'))
->addClass('form-control')->id('form-element-'.$key) }}
                                    @endif
                                @else
                                    @if($value == 'file')
                                        {{ html()->file($key)->name($key)->addClass('form-control')->id('form-element-'.$key) }}
                                    @elseif(\Illuminate\Support\Str::startsWith($value,'get'))
                                        @php($data = (app()->make($model))->{$value}())

                                        {{ html()->select($key)->name($key)->options($data
->select('id','title')->pluck('title','id'))
->placeholder(__('inputs.'.$key.'.placeholder'))
->addClass('form-control')->id('form-element-'.$key) }}
                                    @else
                                        {{ html()->$value($key)->name($key)->placeholder(__('inputs.'.$key.'.placeholder'))->addClass('form-control')->id('form-element-'.$key) }}
                                    @endif
                                @endif
                            @endif
                        </div>
                    @endforeach
                    {{ html()->submit('Kaydet')->addClass('btn btn-success') }}
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
