@extends('layouts.app')

@section('title', 'Submit Leave Request')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="h3 mb-4">Submit Leave Request</h1>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('leave-requests.store') }}" id="leaveForm">
                        @csrf

                        <div class="mb-3">
                            <label for="personnel_id" class="form-label">Personnel <span class="text-danger">*</span></label>
                            <select class="form-select @error('personnel_id') is-invalid @enderror" id="personnel_id" name="personnel_id" required>
                                <option value="">Select Personnel</option>
                                @foreach($personnel as $person)
                                    <option value="{{ $person->id }}" @selected(old('personnel_id') == $person->id)>
                                        {{ $person->getFullName() }} ({{ $person->service_number }})
                                    </option>
                                @endforeach
                            </select>
                            @error('personnel_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="leave_type_id" class="form-label">Leave Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('leave_type_id') is-invalid @enderror" id="leave_type_id" name="leave_type_id" required>
                                <option value="">Select Leave Type</option>
                                @foreach($leaveTypes as $leaveType)
                                    <option value="{{ $leaveType->id }}" @selected(old('leave_type_id') == $leaveType->id)>
                                        {{ $leaveType->name }} ({{ $leaveType->allowed_days_per_year }} days/year)
                                    </option>
                                @endforeach
                            </select>
                            @error('leave_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="4" required>{{ old('reason') }}</textarea>
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact') }}">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit Request
                            </button>
                            <a href="{{ route('leave-requests.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('leaveForm').addEventListener('change', function() {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);
        
        if (startDate && endDate) {
            const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
            console.log('Total days: ' + days);
        }
    });
</script>
@endpush
@endsection