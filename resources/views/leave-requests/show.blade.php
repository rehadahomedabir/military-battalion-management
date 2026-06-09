@extends('layouts.app')

@section('title', 'Leave Request Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3">Leave Request</h1>
            <p class="text-muted">{{ $leaveRequest->personnel->getFullName() }}</p>
        </div>
        <div class="col-md-4 text-end">
            @if($leaveRequest->isPending())
                @can('approve', $leaveRequest)
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                        <i class="fas fa-check"></i> Approve
                    </button>
                @endcan
                @can('reject', $leaveRequest)
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i class="fas fa-times"></i> Reject
                    </button>
                @endcan
                @can('update', $leaveRequest)
                    <a href="{{ route('leave-requests.edit', $leaveRequest) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                @endcan
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Request Details</div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th style="width: 30%">Personnel:</th>
                            <td>{{ $leaveRequest->personnel->getFullName() }}</td>
                        </tr>
                        <tr>
                            <th>Service Number:</th>
                            <td>{{ $leaveRequest->personnel->service_number }}</td>
                        </tr>
                        <tr>
                            <th>Leave Type:</th>
                            <td>{{ $leaveRequest->leaveType->name }}</td>
                        </tr>
                        <tr>
                            <th>Start Date:</th>
                            <td>{{ $leaveRequest->start_date->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <th>End Date:</th>
                            <td>{{ $leaveRequest->end_date->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Total Days:</th>
                            <td>{{ $leaveRequest->total_days }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if($leaveRequest->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($leaveRequest->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($leaveRequest->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Submitted Date:</th>
                            <td>{{ $leaveRequest->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Reason</div>
                <div class="card-body">
                    <p>{{ $leaveRequest->reason }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if($leaveRequest->isApproved())
                <div class="card border-success">
                    <div class="card-header bg-success text-white">Approval Details</div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Approved By:</strong></p>
                        <p class="mb-2">{{ $leaveRequest->approvedBy?->name ?? 'System' }}</p>
                        <p class="mb-2"><strong>Approved Date:</strong></p>
                        <p class="mb-2">{{ $leaveRequest->approved_at?->format('M d, Y h:i A') }}</p>
                        @if($leaveRequest->approval_remarks)
                            <p class="mb-0"><strong>Remarks:</strong></p>
                            <p class="mb-0">{{ $leaveRequest->approval_remarks }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Leave Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('leave-requests.approve', $leaveRequest) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Leave Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('leave-requests.reject', $leaveRequest) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection