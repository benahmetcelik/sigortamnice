@extends('themes.ThemeOne.layouts.app')



@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Canlı Teklif İzle</h4>
                        <p class="text-muted mb-0">Çeşitli firmalardan alınan tekliflere buradan erişebilirsiniz</p>
                    </div>
                </div>
                <div class="card-body">
                    <x-data-table id="offer_requests" :columns="['#','Firma Adı','Servis','Durum','Fiyat','Kabul Edilebilir Mi ?','İşlemler']">
                        @foreach($quoteRequest->getOffers as $item)
                            <tr class="align-middle offer-line" data-id="{{ $item->id }}" data-complete="{{ $item->is_completed ? 'true' : 'false' }}">
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td> {{ $item->getWebService?->name }} </td>
                                <td>{{ $item->getWebServiceModule?->name }}</td>

                                <td class="offer-line-is_completed-{{ $item->id }}">
                                    {!!   $item->is_completed ? '<span class="badge bg-success">Tamamlandı</span>' : '<div class="spinner-border text-primary" role="status">
  <span class="sr-only"></span>
</div>' !!}
                                </td>
                                <td class="offer-line-price-{{ $item->id }}">
                                    {{ $item->price ? $item->price.' ₺' : '----'  }}
                                </td>
                                <td class="offer-line-is_acceptable-{{ $item->id }}">
                                    @if(is_null($item->is_acceptable))
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    @elseif($item->is_acceptable)
                                        <span class="badge bg-success">Kesilebilir</span>
                                    @else
                                        <span class="badge bg-danger">Kesilemez</span>
                                        <br> {{ $item->reason }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary width-xs">İşlemler</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">

                                            <li><a class="dropdown-item" href="{{route('teklif.al.policelestir', $item->id)}}">Poliçeştir</a></li>

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


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function getLastStatus(id){
            var status_line = '.offer-line-is_completed-';
            var price = '.offer-line-price-';
            var is_acceptable = '.offer-line-is_acceptable-';
            $.ajax({
                type: "POST",
                url: '{{ route("admin.teklif-al.live-result") }}',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(response) {
                    if (response) {
                        $(status_line+id).html(
                            response.is_completed ?
                                "<span class=\"badge bg-success\">Tamamlandı</span>" :
                                "<div class=\"spinner-border text-primary\" role=\"status\"><span class=\"sr-only\"></span> </div>"
                        );

                        if(response.is_completed){
                            $(status_line+id).closest('[data-id="'+id+'"]').removeAttr('data-id');
                        }
                        $(price+id).html(
                            response.price > 0 ?
                                response.price + ' ₺' :
                                '---'
                        );
                        $(is_acceptable+id).html(
                            response.is_completed ?
                                response.is_acceptable > 0 ?
                                 '<span class="badge bg-success">Kesilebilir</span>' :
                                 '<span class="badge bg-danger">Kesilemez</span>' + (response.reason !== null ? '<br>'+response.reason : '')
                                :
                                "<div class=\"spinner-border text-primary\" role=\"status\"><span class=\"sr-only\"></span> </div>"

                        );
                    } else {

                    }
                },
                error: function(xhr) {

                }
            });
        }
        setInterval(
            function (){
                var offerLines = $('.offer-line[data-id]');
                offerLines.map(function (index,line){
                    getLastStatus(line.getAttribute('data-id'))
                })
            },
            1000
        )


    </script>

@endsection
