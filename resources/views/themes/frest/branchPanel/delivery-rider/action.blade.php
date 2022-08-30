@if ($riderRun->status === 1)
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-icon btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal">
            <i class='bx bx-show-alt'></i>
        </button>

        <a href="button" class="btn btn-icon btn-success btn-sm" data-bs-toggle="tooltip" data-bs-offset="0,8"
            data-bs-placement="top" data-color="primary" title="" data-bs-original-title="Primary tooltip">
            <i class='bx bxs-printer'></i>
        </a>
        <button type="button" class="btn btn-icon btn-success btn-sm run-start-btn" title="Pickup Run Start"
            data-id="{{ $riderRun->id }}">
            <span> <i class='bx bx-play-circle'></i></span>
        </button>
        <a href="button" class="btn btn-icon btn-sm btn-warning" title="Pickup Run Cancel">
            <span> <i class='bx bxs-x-square'></i></span>
        </a>
        <a href="button" class="btn btn-icon btn-sm btn-info" title="Edit Pickup Run">
            <span><i class='bx bx-edit-alt'></i></span>
        </a>
        <a href="button" class="btn btn-icon btn-info btn-sm" title="Print Pickup Rider Run" title="All Parcel Print">
            <i class='bx bxs-printer'></i>
        </a>
    </div>
@endif
@if ($riderRun->status === 2)
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
@endif
