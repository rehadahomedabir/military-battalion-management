@extends('layouts.app')

@section('title', 'Edit Personnel')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 class="h3 mb-4">Edit Personnel</h1>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('personnel.update', $personnel) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                                <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" @selected(old('company_id', $personnel->company_id) == $company->id)>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="service_number" class="form-label">Service Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('service_number') is-invalid @enderror" id="service_number" name="service_number" value="{{ old('service_number', $personnel->service_number) }}" required>
                                @error('service_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $personnel->first_name) }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $personnel->last_name) }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="father_name" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name', $personnel->father_name) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rank_id" class="form-label">Rank <span class="text-danger">*</span></label>
                                <select class="form-select @error('rank_id') is-invalid @enderror" id="rank_id" name="rank_id" required>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->id }}" @selected(old('rank_id', $personnel->rank_id) == $rank->id)>
                                            {{ $rank->name }} ({{ $rank->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('rank_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="trade_id" class="form-label">Trade</label>
                                <select class="form-select" id="trade_id" name="trade_id">
                                    <option value="">Select Trade</option>
                                    @foreach($trades as $trade)
                                        <option value="{{ $trade->id }}" @selected(old('trade_id', $personnel->trade_id) == $trade->id)>
                                            {{ $trade->name }} ({{ $trade->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $personnel->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $personnel->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="active" @selected(old('status', $personnel->status) === 'active')>Active</option>
                                    <option value="on_leave" @selected(old('status', $personnel->status) === 'on_leave')>On Leave</option>
                                    <option value="suspended" @selected(old('status', $personnel->status) === 'suspended')>Suspended</option>
                                    <option value="retired" @selected(old('status', $personnel->status) === 'retired')>Retired</option>
                                    <option value="discharged" @selected(old('status', $personnel->status) === 'discharged')>Discharged</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <select class="form-select" id="blood_group" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" @selected(old('blood_group', $personnel->blood_group) === 'A+')>A+</option>
                                    <option value="A-" @selected(old('blood_group', $personnel->blood_group) === 'A-')>A-</option>
                                    <option value="B+" @selected(old('blood_group', $personnel->blood_group) === 'B+')>B+</option>
                                    <option value="B-" @selected(old('blood_group', $personnel->blood_group) === 'B-')>B-</option>
                                    <option value="O+" @selected(old('blood_group', $personnel->blood_group) === 'O+')>O+</option>
                                    <option value="O-" @selected(old('blood_group', $personnel->blood_group) === 'O-')>O-</option>
                                    <option value="AB+" @selected(old('blood_group', $personnel->blood_group) === 'AB+')>AB+</option>
                                    <option value="AB-" @selected(old('blood_group', $personnel->blood_group) === 'AB-')>AB-</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Personnel
                            </button>
                            <a href="{{ route('personnel.show', $personnel) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection