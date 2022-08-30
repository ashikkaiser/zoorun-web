<button onclick="editRow({{ $row }})" class="edit btn btn-primary btn-sm me-1">Edit</button>

@if ($row->status)
    <button onclick="deleteRow({{ $row->id }}, 'trash')" class="edit btn btn-danger btn-sm ">Trash</button>
@else
    <button onclick="deleteRow({{ $row->id }}, 'untrash')" class="edit btn btn-success btn-sm ">Untrash</button>
@endif
