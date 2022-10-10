<div class="modal-header">
    <h5 class="modal-title">Make Payment For Invoice ID - <span
            class="text-success fw-bold">{{ $payment_id->invoice_id }}</span> </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('branch.accounts.merchant.delivery.payment.submitPaymentModal', $payment_id->id) }}"
    method="POST">
    @csrf
    <div class="modal-body">
        {{ $payment_id }}
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="form-label">Total Payable Amount</label>
                <select name="payment_method" id="" class="form-select">
                    <option value="">Select Payment Method</option>
                    @foreach ($payment_method as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Total Payable Amount</label>
                <input type="text" class="form-control" value="{{ $payment_id->total_amount }}" readonly />
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Payment Slip Number</label>
                <input type="text" name="payment_slip" class="form-control"
                    placeholder="Enter Payment Slip Number" />
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Payment Note</label>
                <textarea class="form-control" name="payment_note" id="" rows="2"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
