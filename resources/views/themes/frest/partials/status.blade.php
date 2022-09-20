{{-- @if ($row->is_active)
    <span class="badge bg-success">$row->is_active</span>
@else
    @if ($row->is_active == 'pending')
        <span class="badge bg-warning">Pending</span>
    @else
        <span class="badge bg-danger">Inactive</span>
    @endif
    <span class="badge bg-danger">Deleted</span>
@endif --}}
@if ($row->is_active == 'active')
    <span class="badge bg-success">{{ $row->is_active }}</span>
@elseif ($row->is_active == 'pending')
    <span class="badge bg-warning">{{ $row->is_active }}</span>
@elseif ($row->is_active == 'inactive')
    <span class="badge bg-danger">{{ $row->is_active }}</span>
@endif
