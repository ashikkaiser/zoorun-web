<a href={{ route('admin.team.merchant.edit', $row->id) }} class="edit btn btn-primary btn-sm me-1">Edit</a>

@if ($row->status)
    <button onclick="deleteRow({{ $row->id }}, 'trash')" class="edit btn btn-danger btn-sm ">Trash</button>
@else
    @if (count(json_decode($row->service_area_id)) == 0)
        {{-- <button class="edit btn btn-success btn-sm "></button> --}}
    @else
        <button onclick="deleteRow({{ $row->id }}, 'untrash')" class="edit btn btn-success btn-sm ">Untrash</button>
    @endif

@endif
