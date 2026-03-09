<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class AdminReports extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public string $category = '';

    public string $dateFrom = '';

    public string $dateTo = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'category' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
    ];

    public function updated($property): void
    {
        if (in_array($property, ['search', 'status', 'category', 'dateFrom', 'dateTo'], true)) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Report::query()->with('user');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', function ($uq) {
                        $uq->where('name', 'like', '%'.$this->search.'%')
                            ->orWhere('email', 'like', '%'.$this->search.'%');
                    });
            });
        }

        if ($this->status !== '') {
            $query->where('status', $this->status);
        }

        if ($this->category !== '') {
            $query->where('category', $this->category);
        }

        if ($this->dateFrom !== '') {
            $query->whereDate('waktu_pelaporan', '>=', $this->dateFrom);
        }

        if ($this->dateTo !== '') {
            $query->whereDate('waktu_pelaporan', '<=', $this->dateTo);
        }

        $reports = $query
            ->latest('waktu_pelaporan')
            ->paginate(10);

        $categories = Report::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->all();

        return view('livewire.admin-reports', [
            'reports' => $reports,
            'categories' => $categories,
        ])->layout('components.layouts.app', [
            'title' => 'Kelola Laporan',
        ]);
    }
}
