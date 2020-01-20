





<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Base</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($base as $base)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $base->name }}</td>
                <td>
                    <a href="{{ route('mixing.base.edit', ['id'=>$base->id]) }}" class="btn btn-sm btn-warning fas fa-pencil-alt"></a>
                    <button class="btn btn-sm btn-danger far fa-trash-alt deleteBase" data-id="{{ $base->id }}"></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>