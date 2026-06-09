@extends('layouts.app')

@section('title', $personnel->getFullName())

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3">{{ $personnel->getFullName() }}</h1>
            <p class="text-muted">{{ $personnel->getRankName() }} | {{ $personnel->service_number }}</p>
        </div>
        <div class="col-md-4 text-end">
            @can('update', $personnel)
                <a href="{{ route('personnel.edit', $personnel) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            @endcan
            @can('delete', $personnel)
                <form method="POST" action="{{ route('personnel.destroy', $personnel) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            @endcan
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-left-primary">
                <div class="card-body">
                    <div class="small font-weight-bold text-primary">Age</div>
                    <div class="h4">{{ $statistics['age'] }} years</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-success">
                <div class="card-body">
                    <div class="small font-weight-bold text-success">Active Leaves</div>
                    <div class="h4">{{ $statistics['active_leave_requests'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-info">
                <div class="card-body">
                    <div class="small font-weight-bold text-info">Courses Completed</div>
                    <div class="h4">{{ $statistics['completed_courses'] }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-warning">
                <div class="card-body">
                    <div class="small font-weight-bold text-warning">Attendance %</div>
                    <div class="h4">{{ number_format($statistics['attendance_percentage'], 1) }}%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Personal Information</div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th style="width: 40%">Email:</th>
                            <td>{{ $personnel->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $personnel->phone }}</td>
                        </tr>
                        <tr>
                            <th>CNIC:</th>
                            <td>{{ $personnel->cnic }}</td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td>{{ ucfirst($personnel->gender) }}</td>
                        </tr>
                        <tr>
                            <th>Blood Group:</th>
                            <td>{{ $personnel->blood_group ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth:</th>
                            <td>{{ $personnel->date_of_birth->format('M d, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Military Information</div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr>
                            <th style="width: 40%">Service Number:</th>
                            <td>{{ $personnel->service_number }}</td>
                        </tr>
                        <tr>
                            <th>Rank:</th>
                            <td>{{ $personnel->rank->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Trade:</th>
                            <td>{{ $personnel->trade->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Company:</th>
                            <td>{{ $personnel->company->name }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if($personnel->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($personnel->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Joining Date:</th>
                            <td>{{ $personnel->joining_date->format('M d, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Address Information</div>
                <div class="card-body">
                    <p class="mb-2"><strong>{{ $personnel->address }}</strong></p>
                    <p class="mb-2">{{ $personnel->city }}, {{ $personnel->province }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Next of Kin</div>
                <div class="card-body">
                    <p class="mb-2"><strong>{{ $personnel->next_of_kin ?? 'Not provided' }}</strong></p>
                    <p class="mb-0">{{ $personnel->next_of_kin_phone ?? 'No phone' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection