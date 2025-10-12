<table class="table table-bordered  nowrap table-striped align-middle" id="{{$id}}" style="width: 100%">
    <thead>
    <tr class="bg-soft-success">
        @foreach($columns as $column)
            <th class="text-dark-emphasis">{{$column}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    {{$slot}}
    </tbody>
</table>
