<div class="demo-inline-spacing">
    <button class="btn btn-success btn-icon btn-sm accept_parcel" onclick='statusChange({{ $booking->id }} ,1)'> <i
            class="bx bx-check-circle"></i></button>
    <button class="btn btn-danger btn-sm btn-icon" onclick="statusChange({{ $booking->id }} ,2)"> <i
            class="bx bxs-x-square"></i></button>
    <button class="btn btn-warning btn-sm btn-icon"> <i class="bx bx-edit-alt"></i></button>
</div>
