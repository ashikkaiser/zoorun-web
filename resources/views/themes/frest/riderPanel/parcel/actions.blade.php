@if ($type === 'pickup-running')
    @if ($parcel->status === 'pickup-completed')
    @else
        <div class="demo-inline-spacing">
            <button type="button" class="btn btn-icon btn-secondary btn-sm view-modal" data-tooltip="tooltip"
                parcel_id="{{ $parcel->id }}" data-bs-toggle="modal" data-bs-target="#viewModal" title="View Parcel">
                <i class='bx bx-show-alt'></i>
            </button>
            <button type="button" class="btn btn-icon btn-success btn-sm confirm-modal" data-tooltip="tooltip"
                parcel_id="{{ $parcel->id }}" data-bs-toggle="modal" data-bs-target="#confirmModal"
                title="Pickup Rider Run">
                <i class='bx bx-check'></i>
            </button>

            <button type="button" class="btn btn-icon btn-sm btn-warning reschedule-modal" data-tooltip="tooltip"
                parcel_id="{{ $parcel->id }}" data-bs-toggle="modal" data-bs-target="#rescheduleModal"
                title="Pickup Run Reschedule">
                <span> <i class='bx bx-timer'></i></span>
            </button>
        </div>
    @endif
@endif
@if ($type === 'pickup-pending')
    <div class="demo-inline-spacing">
        <button type="button" class="btn btn-icon btn-secondary btn-sm view-modal" data-tooltip="tooltip"
            parcel_id="{{ $parcel->id }}" data-bs-toggle="modal" data-bs-target="#viewModal" title="View Parcel">
            <i class='bx bx-show-alt'></i>
        </button>
        <button type="button" class="btn btn-icon btn-success btn-sm accept-parcel" data-tooltip="tooltip"
            parcel_id="{{ $parcel->id }}" title="Accept This Parcel">
            <i class='bx bx-check'></i>
        </button>


    </div>
@endif
