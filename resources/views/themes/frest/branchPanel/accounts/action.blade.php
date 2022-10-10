@if ($data->payment_status == 'paid')
    <span class="badge bg-label-success">Paid</span>
    <button type="button" class="btn btn-xs btn-primary view-modal" payment_id="{{ $data->id }}" data-bs-toggle="modal"
        data-bs-target="#viewModal">View Invoice</button>
@elseif($data->payment_status == 'pending')
    <span class="badge bg-label-warning">Pending</span>
    <button type="button" class="btn btn-xs btn-success payment-modal" payment_id="{{ $data->id }}"
        data-bs-toggle="modal" data-bs-target="#paymentModal">Make
        Payment</button>
    <button type="button" class="btn btn-xs btn-primary view-modal" payment_id="{{ $data->id }}"
        data-bs-toggle="modal" data-bs-target="#viewModal">View Invoice</button>
@endif
