<div class="demo-inline-spacing">
    <button type="button" class="btn btn-icon btn-secondary btn-sm view-modal" data-bs-toggle="modal"
        rider_run_id="{{ $riderRun->id }}" data-bs-target="#viewModal">
        <i class='bx bx-show-alt'></i>
    </button>
    @if ($riderRun->status === 1)
        <a href="button" class="btn btn-icon btn-info btn-sm" title="Print Pickup Rider Run" title="All Parcel Print">
            <i class='bx bxs-printer'></i>
        </a>
    @endif
    @if ($riderRun->status === 2)
        <a href="button" class="btn btn-icon btn-info btn-sm" title="Print Pickup Rider Run" title="All Parcel Print">
            <i class='bx bxs-printer'></i>
        </a>
    @endif

</div>
{{-- @if ($riderRun->status === 2)
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-icon btn-secondary btn-sm" data-bs-toggle="modal" data-toggle="tooltip"
            data-bs-target="#viewModal" title="View Details">
            <i class='bx bx-show-alt'></i>
        </button>
        <button type="button" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" title="Print List">
            <i class='bx bxs-printer'></i>
        </button>
        <button type="button" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" title="Pickup Run Start"
            data-id="{{ $riderRun->id }}">
            <span> <i class='bx bx-check-circle'></i></span>
        </button>


        <a href="button" class="btn btn-icon btn-info btn-sm" data-toggle="tooltip" title="Print Invoice">
            <i class='bx bxs-printer'></i>
        </a>
    </div>
@endif --}}
{{-- @if ($riderRun->status === 3)
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-icon btn-secondary btn-sm view-modal" rider_run_id="{{ $riderRun->id }}"
            data-bs-toggle="modal" data-toggle="tooltip" data-bs-target="#viewModal" title="View Details">
            <i class='bx bx-show-alt'></i>
        </button>
        <button type="button" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" title="Print List">
            <i class='bx bxs-printer'></i>
        </button>
        <button type="button" class="btn btn-icon btn-success btn-sm" data-toggle="tooltip" title="Pickup Run Start"
            data-id="{{ $riderRun->id }}">
            <span> <i class='bx bx-check-circle'></i></span>
        </button>


        <a href="button" class="btn btn-icon btn-info btn-sm" data-toggle="tooltip" title="Print Invoice">
            <i class='bx bxs-printer'></i>
        </a>
    </div>
@endif --}}
