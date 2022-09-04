<div class="demo-inline-spacing">
    <a target="_blank" href="{{ route('merchant.parcel.booking.generatePrintLabels', $booking->id) }}"
        class="btn btn-secondary btn-icon btn-sm" data-toggle="tooltip" title="Print Lable">
        <i class="bx bx-printer"></i>
    </a>
    @if ($booking->status === 'pickup-pending')
        <button onclick="cancel_pickup(' . $booking->id . ')" class="btn btn-danger btn-icon btn-sm cancel_pickup"
            data-toggle="tooltip" title="Cancel Pickup">
            <i class="bx bx-x"></i>
        </button>
    @endif
    @if ($booking->status === 'pickup-accepted')
        @if ($booking->is_hold == 0)
            <button onclick="hold_pickup($booking->id)" class="btn btn-warning btn-icon btn-sm hold_pickup"
                data-toggle="tooltip" title="Hold Pickup">
                <i class="bx bx-pause"></i>
            </button>
        @else
            <button onclick="hold_pickup($booking->id)" class="btn btn-success btn-icon btn-sm hold_pickup"
                data-toggle="tooltip" title="Hold Pickup">
                <i class="bx bx-play"></i>
            </button>
        @endif

        <a href="javascript:void(0)" class="btn btn-info btn-sm btn-icon " data-toggle="tooltip"
            title="Request Return Parcel">
            <i class="bx bx-undo"></i>
        </a>;

    @endif
    @if ($booking->is_return === true)
        @if ($booking->return_status === 'return-requested')
            <a href="javascript:void(0)" class="btn btn-success btn-sm btn-icon " data-toggle="tooltip"
                title="Cancle Return Parcel">
                <i class="bx bx-x"></i>
            </a>
        @else
            <a href="javascript:void(0)" class="btn btn-info btn-sm btn-icon " data-toggle="tooltip"
                title="Return Parcel">
                <i class="bx bx-undo"></i>
            </a>
        @endif
    @endif
    @if ($booking->status === 'delivery-completed')
        <button onclick="request_return({{ $booking->id }})" class="btn btn-info btn-sm btn-icon "
            data-toggle="tooltip" title="Request Return Parcel">
            <i class="bx bx-undo"></i>
        </button>
    @endif

</div>
