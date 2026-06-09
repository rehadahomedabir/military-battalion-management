@extends('layouts.app')

@section('title', 'Add Personnel')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 class="h3 mb-4">Add New Personnel</h1>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('personnel.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="company_id" class="form-label">Company <span class="text-danger">*</span></label>
                                <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>
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
                                <input type="text" class="form-control @error('service_number') is-invalid @enderror" id="service_number" name="service_number" value="{{ old('service_number') }}" required>
                                @error('service_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="father_name" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rank_id" class="form-label">Rank <span class="text-danger">*</span></label>
                                <select class="form-select @error('rank_id') is-invalid @enderror" id="rank_id" name="rank_id" required>
                                    <option value="">Select Rank</option>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->id }}" @selected(old('rank_id') == $rank->id)>
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
                                        <option value="{{ $trade->id }}" @selected(old('trade_id') == $trade->id)>
                                            {{ $trade->name }} ({{ $trade->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cnic" class="form-label">CNIC <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('cnic') is-invalid @enderror" id="cnic" name="cnic" value="{{ old('cnic') }}" required>
                                @error('cnic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" @selected(old('gender') === 'male')>Male</option>
                                    <option value="female" @selected(old('gender') === 'female')>Female</option>
                                    <option value="other" @selected(old('gender') === 'other')>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <select class="form-select" id="blood_group" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" @selected(old('blood_group') === 'A+')>A+</option>
                                    <option value="A-" @selected(old('blood_group') === 'A-')>A-</option>
                                    <option value="B+" @selected(old('blood_group') === 'B+')>B+</option>
                                    <option value="B-" @selected(old('blood_group') === 'B-')>B-</option>
                                    <option value="O+" @selected(old('blood_group') === 'O+')>O+</option>
                                    <option value="O-" @selected(old('blood_group') === 'O-')>O-</option>
                                    <option value="AB+" @selected(old('blood_group') === 'AB+')>AB+</option>
                                    <option value="AB-" @selected(old('blood_group') === 'AB-')>AB-</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="active" @selected(old('status') === 'active')>Active</option>
                                    <option value="on_leave" @selected(old('status') === 'on_leave')>On Leave</option>
                                    <option value="suspended" @selected(old('status') === 'suspended')>Suspended</option>
                                    <option value="retired" @selected(old('status') === 'retired')>Retired</option>
                                    <option value="discharged" @selected(old('status') === 'discharged')>Discharged</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}" required>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="joining_date" class="form-label">Joining Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ old('joining_date') }}" required>
                                @error('joining_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="commission_date" class="form-label">Commission Date</label>
                                <input type="date" class="form-control" id="commission_date" name="commission_date" value="{{ old('commission_date') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="next_of_kin" class="form-label">Next of Kin</label>
                                <input type="text" class="form-control" id="next_of_kin" name="next_of_kin" value="{{ old('next_of_kin') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="next_of_kin_phone" class="form-label">Next of Kin Phone</label>
                                <input type="tel" class="form-control" id="next_of_kin_phone" name="next_of_kin_phone" value="{{ old('next_of_kin_phone') }}">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Add Personnel
                            </button>
                            <a href="{{ route('personnel.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection