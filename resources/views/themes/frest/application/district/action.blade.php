<button data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id }}"
    class="edit btn btn-primary btn-sm me-1">Edit</button>
<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Edit District</h3>
                </div>
                <form action="{{ route('admin.application.district.update', $row->id) }}"
                    id="editModalForm{{ $row->id }}" class="row g-3" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label w-100" for="name">Name</label>
                        <div class="input-group input-group-merge">
                            <input id="name" name="name" class="form-control credit-card-mask" type="text"
                                placeholder="Kushtia" aria-describedby="name2" required value="{{ $row->name }}" />
                        </div>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if ($row->status)
    <button onclick="deleteRow({{ $row->id }}, 'trash')" class="edit btn btn-danger btn-sm ">Trash</button>
@else
    <button onclick="deleteRow({{ $row->id }}, 'untrash')" class="edit btn btn-success btn-sm ">Untrash</button>
@endif
