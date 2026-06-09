<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class CompanyService
{
    protected $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all companies with pagination
     */
    public function getAllPaginated(int $perPage = 15): Paginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Get all active companies
     */
    public function getAllActive(): Collection
    {
        return $this->repository->getAllActive();
    }

    /**
     * Get company by ID
     */
    public function getById(int $id): ?Company
    {
        return $this->repository->findById($id);
    }

    /**
     * Get company by code
     */
    public function getByCode(string $code): ?Company
    {
        return $this->repository->findByCode($code);
    }

    /**
     * Create a new company
     */
    public function create(array $data): Company
    {
        return $this->repository->create($data);
    }

    /**
     * Update company
     */
    public function update(int $id, array $data): Company
    {
        $company = $this->repository->findById($id);
        if (!$company) {
            throw new \Exception('Company not found');
        }

        return $this->repository->update($id, $data);
    }

    /**
     * Delete company
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Permanently delete company
     */
    public function forceDelete(int $id): bool
    {
        return $this->repository->forceDelete($id);
    }

    /**
     * Restore soft deleted company
     */
    public function restore(int $id): bool
    {
        return $this->repository->restore($id);
    }

    /**
     * Get company statistics
     */
    public function getStatistics(int $companyId): array
    {
        $company = $this->repository->findById($companyId);

        if (!$company) {
            throw new \Exception('Company not found');
        }

        return [
            'total_personnel' => $company->getTotalPersonnelCount(),
            'active_personnel' => $company->getActivePersonnelCount(),
            'total_teams' => $company->teams()->count(),
            'total_parades' => $company->paradeSchedules()->count(),
            'pending_leave_requests' => $company->personnels()
                ->with('leaveRequests')
                ->get()
                ->flatMap->leaveRequests
                ->filter(fn($lr) => $lr->isPending())
                ->count(),
        ];
    }

    /**
     * Search companies
     */
    public function search(string $query): Collection
    {
        return $this->repository->search($query);
    }
}
