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

    public $tab = 'masyarakat';

    public function render()
    {
        if ($this->tab === 'masyarakat') {

            $query = User::query()
                ->with('masyarakat')
                ->where('role', 'user')
                ->whereHas('masyarakat');

            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            }

            $data = $query->latest()->paginate(10);
        } else {

            $query = User::query();

            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            }

            $data = $query->latest()->paginate(10);
        }

        return view('livewire.admin-users', [
            'users' => $data,
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
