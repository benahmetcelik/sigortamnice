@extends('backend.layout.layout')
@section('title', 'Onaylanmış Domainler')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Kullanıcılar</h4>
                        <p class="text-muted mb-0">Kullanıcılarınızı bu tablodan yönetebilirsiniz.</p>
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-green btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addModal"> Kullanıcı Ekle
                            <iconify-icon icon="mingcute:plus-fill" class="ms-2"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="users" :columns="['#','Kullanıcı Adı','E-Posta','Kayıt Tarihi','İşlemler']">
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->format('d.m.Y H:i')}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-json="{{$user}}">Düzenle</button>
                                    <a href="{{route('admin.users.delete', $user->id)}}" class="btn btn-danger btn-sm">Sil</a>
                            </tr>
                        @endforeach
                    </x-data-table>
                </div>
            </div>
        </div>
    </div>

    <x-modal id="editModal" title="Kullanıcı Düzenle">
        <form action="{{route('admin.users.update')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="domain" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="name" name="name">
                <input type="hidden" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-Posta</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </x-modal>

    <x-modal id="addModal" title="Kullanıcı Ekle">
        <form action="{{route('admin.users.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="domain" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-Posta</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="password" name="password">
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
                modal.find('.modal-body #name').val(data.name);
                modal.find('.modal-body #email').val(data.email);
                modal.find('.modal-body #password').val(data.password);
                modal.find('.modal-body #id').val(data.id);
            });
        });


    </script>

@endsection
