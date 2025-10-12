@extends('backend.layout.layout')
@section('title', 'Domain Modülleri')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Domain Modülleri</h4>
                        <p class="text-muted mb-0">Domain modüllerinizi bu tablodan yönetebilirsiniz.</p>
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-green btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addModal"> Modül Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="domain-module" :columns="['#','Sigorta Şirketi','Modül','Kayıt Tarihi','İşlemler']">
                        @foreach($domain->modules as $domainModule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $domainModule->webService->name }}</td>
                                <td>{{ $domainModule->webServiceModule->name }}</td>
                                <td>{{ $domainModule->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-json='@json($domainModule)'>
                                        Düzenle
                                    </button>
                                    <a href="{{ route('admin.domain-modules.deleteModule', ['id' => $domainModule->id]) }}" class="btn btn-sm btn-danger">Sil</a>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#settingModule" data-json='@json($domainModule)'>
                                        Ayarlar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                </div>

            </div>
        </div>
    </div>



    <x-modal id="addModal" title="Modül Ekle">
        <form action="{{route('admin.domain-modules.addModule')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="domain" class="form-label">Sigorta Şirketi</label>
                <select name="web_service_id" id="web_service_id" class="form-select">
                    <option value="" selected disabled>Sigorta Şirketi Seçiniz</option>
                    @foreach($webServices as $webService)
                        <option value="{{$webService->id}}" data-module="{{$webService->modules}}">{{$webService->name}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="domain_id" value="{{$domain->id}}">
            </div>
            <div class="mb-3" id="moduleSelect" style="display: none;">
                <label for="web_service_module_id" class="form-label">Modül</label>
                <select name="web_service_module_id" id="web_service_module_id" class="form-select">
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </x-modal>

    <x-modal id="editModal" title="Modül Güncelle">
        <form action="{{route('admin.domain-modules.updateModule')}}" method="POST">
            @csrf


            <!-- ID Gizli Alan -->
            <input type="hidden" name="id" id="edit_id">
            <input type="hidden" name="domain_id" value="{{$domain->id}}">

            <!-- Sigorta Şirketi -->
            <div class="mb-3">
                <label for="edit_web_service_id" class="form-label">Sigorta Şirketi</label>
                <select name="web_service_id" id="edit_web_service_id" class="form-select">
                    <option value="" selected disabled>Sigorta Şirketi Seçiniz</option>
                    @foreach($webServices as $webService)
                        <option value="{{ $webService->id }}">{{ $webService->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Modül -->
            <div class="mb-3">
                <label for="edit_web_service_module_id" class="form-label">Modül</label>
                <select name="web_service_module_id" id="edit_web_service_module_id" class="form-select">
                    <!-- Dinamik olarak dolacak -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </x-modal>

    <x-modal id="settingModule" title="Modül Ayarları">
        <form action="{{route('admin.domain-modules.updateSettings')}}" method="post" id="settingModuleForm">
            @csrf
            <div id="inputs">

            </div>

        </form>
    </x-modal>



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



            $('#web_service_id').on('change', function () {
                var selectedModule = $('#web_service_id option:selected').data('module');
                var moduleSelect = $('#moduleSelect');
                var webServiceModuleId = $('#web_service_module_id');
                if(selectedModule.length > 0){
                    moduleSelect.show();
                    webServiceModuleId.empty();
                    selectedModule.forEach(function (module) {
                        webServiceModuleId.append('<option value="'+module.id+'">'+module.name+'</option>');
                    });
                }else{
                    moduleSelect.hide();
                }
            });

            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Tıklanan buton
                var data = button.data('json'); // JSON verisi

                // Modal içinde ilgili alanları doldurma
                var modal = $(this);
                modal.find('#edit_id').val(data.id);
                modal.find('#edit_web_service_id').val(data.web_service_id).change(); // Sigorta şirketini seç

                // Sigorta şirketi seçildiğinde modülleri güncelle
                var webServiceModules = @json($webServices->flatMap(fn($ws) => $ws->modules));
                var selectedModules = webServiceModules.filter(module => module.web_service_id == data.web_service_id);

                var moduleSelect = modal.find('#edit_web_service_module_id');
                moduleSelect.empty();
                selectedModules.forEach(function (module) {
                    moduleSelect.append('<option value="' + module.id + '">' + module.name + '</option>');
                });

                // Seçili modülü seç
                modal.find('#edit_web_service_module_id').val(data.web_service_module_id);
            });

            // Sigorta şirketi seçildiğinde modülleri güncelleme
            $('#edit_web_service_id').on('change', function () {
                var webServiceId = $(this).val();
                var webServiceModules = @json($webServices->flatMap(fn($ws) => $ws->modules));
                var selectedModules = webServiceModules.filter(module => module.web_service_id == webServiceId);

                var moduleSelect = $('#edit_web_service_module_id');
                moduleSelect.empty();
                selectedModules.forEach(function (module) {
                    moduleSelect.append('<option value="' + module.id + '">' + module.name + '</option>');
                });
            });

            $('#settingModule').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Butonu alıyoruz
                var data = button.data('json'); // data-json'u alıyoruz
                var inputs = $('#settingModuleForm').find('#inputs');
                var modal = $(this);
                console.log(data);

                inputs.empty();
                if(data.settings == null){
                    data.web_service_module.requirements.forEach(function (requirement) {
                        var formGroup = $('<div class="mb-3"></div>');
                        var label = $('<label for="' + requirement.key + '" class="form-label">' + requirement.label + '</label>');
                        var input = $('<input type="text" class="form-control" name="' + requirement.key + '" id="' + requirement.key + '">');
                        formGroup.append(label);
                        formGroup.append(input);
                        inputs.append(formGroup);
                    });

                }else{
                    data.settings.forEach(function (setting) {
                        var formGroup = $('<div class="mb-3"></div>');
                        var label = $('<label for="' + setting.key + '" class="form-label" >' +data.web_service_module.requirements.find(x => x.key === setting.key).label + '</label>');
                        var input = $('<input type="text" class="form-control" name="' + setting.key + '" id="' + setting.key + '" value="' + setting.value + '">');
                        formGroup.append(label);
                        formGroup.append(input);
                        inputs.append(formGroup);
                    });
                }
                // Hidden input ekle: module_id
                inputs.append('<input type="hidden" name="module_id" id="module_id">');
                inputs.append('<input type="hidden" name="domain_id" value="{{$domain->id}}">');
                // Kaydet butonunu ekle
                var submitButton = $('<button type="submit" class="btn btn-primary">Kaydet</button>');
                inputs.append(submitButton);
                modal.find('#module_id').val(data.id);
            });


        });


    </script>

@endsection
