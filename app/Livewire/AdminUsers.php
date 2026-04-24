<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $role = '';
    public $dateFrom = '';
    public $dateTo = '';

    public function render()
    {
        $query = User::query();

        // 🔍 SEARCH
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // 👤 ROLE FILTER
        if ($this->role) {
            $query->where('role', $this->role);
        }

        // 📅 DATE FILTER
        if ($this->dateFrom) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        // ambil data
        $users = $query->latest()->paginate(10);

        return view('livewire.admin-users', [
            'users' => $users,
        ])->layout('components.layouts.app', [
            'title' => 'Data Masyarakat',
        ]);
    }

    // reset pagination saat filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingRole()
    {
        $this->resetPage();
    }
    public function updatingDateFrom()
    {
        $this->resetPage();
    }
    public function updatingDateTo()
    {
        $this->resetPage();
    }
}
