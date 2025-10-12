@extends('backend.layout.layout')
@section('title', 'Onaylanmış Domainler')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Onaylı Domainler</h4>
                        <p class="text-muted mb-0">Onaylı domainlerinizi buradan yönetebilirsiniz.</p>
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-green btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addModal"> Domain Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="allowed-domain" :columns="['#','Domain Adı','Bitiş Tarihi','Durum','Tema','İşlemler']">
                        @foreach($domains as $allowed_domain)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $allowed_domain->domain }}</td>
                                <td>{{ $allowed_domain->expires_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    {!!   $allowed_domain->status ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Pasif</span>' !!}
                                </td>
                                <td>
                                    @if($allowed_domain->theme)
                                        <span class="badge bg-primary">{{ $allowed_domain->theme->name }}</span>
                                    @else
                                        <span class="badge bg-danger">Tema Yok</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary width-xs">İşlemler</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" data-json='{{$allowed_domain }}' data-bs-toggle="modal" data-bs-target="#editModal">Düzenle</button></li>
                                            <li><a class="dropdown-item" href="{{route('admin.allowed-domains.delete', $allowed_domain->id)}}">Sil</a></li>
                                            <li><a class="dropdown-item" href="{{route('admin.allowed-domains.users', $allowed_domain->id)}}">Kullanıcılar</a></li>
                                            <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addThemeModal" data-json='{{$allowed_domain }}'>Tema Ekle</button></li>
                                            <li><a class="dropdown-item" href="{{route('admin.domain-modules.index', $allowed_domain->id)}}">Modüller</a></li>
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

    <x-modal id="addThemeModal" title="Tema Ekleme">
        <form action="{{route('admin.allowed-domains.selectTheme')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tema Adı</label>
                <input type="hidden" class="form-control" id="domain_id" name="domain_id">
                <select class="form-select" id="theme_id" name="theme_id">
                    @foreach($themes as $theme)
                        <option value="{{$theme->id}}">{{$theme->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </x-modal>


    <x-modal id="editModal" title="Domain Düzenleme">
        <form action="{{route('admin.allowed-domains.update')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="domain" class="form-label">Domain Adı</label>
                <input type="text" class="form-control" id="domain" name="domain">
                <input type="hidden" name="id" id="id">
            </div>
            <div class="mb-3">
                <label for="expires_at" class="form-label">Bitiş Tarihi</label>
                <input type="datetime-local" class="form-control" id="expires_at" name="expires_at">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Durum</label>
                <select class="form-select" id="status" name="status">
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </x-modal>

    <x-modal id="addModal" title="Domain Ekleme">
        <form action="{{route('admin.allowed-domains.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="domain" class="form-label">Domain Adı</label>
                <input type="text" class="form-control" id="domain" name="domain">
            </div>
            <div class="mb-3">
                <label for="expires_at" class="form-label">Bitiş Tarihi</label>
                <input type="datetime-local" class="form-control" id="expires_at" name="expires_at">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Durum</label>
                <select class="form-select" id="status" name="status">
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
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

            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Butonu alıyoruz
                var data = button.data('json'); // data-json'u alıyoruz
                console.log(data); // Kontrol için log
                var modal = $(this);
                var formattedDate = new Date(data.expires_at).toISOString().slice(0, 16);
                modal.find('.modal-body #domain').val(data.domain);
                modal.find('.modal-body #expires_at').val(formattedDate); // Düzeltilmiş format
                modal.find('.modal-body #status').val(data.status ? 1 : 0);
                modal.find('.modal-body #id').val(data.id);
            });
        });

        $('#addThemeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Butonu alıyoruz
            var data = button.data('json'); // data-json'u alıyoruz
            var modal = $(this);
            modal.find('.modal-body #domain_id').val(data.id);
            var themeSelect = modal.find('.modal-body #theme_id');
            themeSelect.val(data.theme_id);
        });


    </script>

@endsection
