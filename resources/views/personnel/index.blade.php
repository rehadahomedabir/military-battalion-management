@extends('layouts.app')

@section('title', 'Personnel Management')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3">Personnel Management</h1>
        </div>
        <div class="col-md-4 text-end">
            @can('create', \App\Models\Personnel::class)
                <a href="{{ route('personnel.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Personnel
                </a>
            @endcan
        </div>
    </div>

    <!-- Search -->
    <div class="row mb-3">
        <div class="col-md-12">
            <form method="GET" action="{{ route('personnel.search') }}" class="d-flex gap-2">
                <input type="text" name="q" class="form-control" placeholder="Search personnel by name, service number, email...">
                <button type="submit" class="btn btn-secondary">Search</button>
            </form>
        </div>
    </div>

    <!-- Personnel Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Service Number</th>
                        <th>Name</th>
                        <th>Rank</th>
                        <th>Trade</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($personnel as $person)
                        <tr>
                            <td>{{ $person->service_number }}</td>
                            <td><strong>{{ $person->getFullName() }}</strong></td>
                            <td>{{ $person->rank->name ?? 'N/A' }}</td>
                            <td>{{ $person->trade->name ?? 'N/A' }}</td>
                            <td>{{ $person->company->name }}</td>
                            <td>
                                @if($person->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($person->status === 'retired')
                                    <span class="badge bg-secondary">Retired</span>
                                @else
                                    <span class="badge bg-warning">{{ ucfirst($person->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('personnel.show', $person) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('update', $person)
                                    <a href="{{ route('personnel.edit', $person) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete', $person)
                                    <form method="POST" action="{{ route('personnel.destroy', $person) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No personnel found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row mt-3">
        <div class="col-md-12">
            {{ $personnel->links() }}
        </div>
    </div>
</div>
@endsection
